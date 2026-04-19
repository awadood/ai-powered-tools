<?php

namespace App\Livewire;

use App\Enums\BookingCategory;
use App\Enums\DisruptionType;
use App\Services\Anthropic\AnthropicRequestException;
use App\Services\FlightDisruptionNotification\FlightDisruptionNotificationData;
use App\Services\FlightDisruptionNotification\GenerateFlightDisruptionNotification;
use App\Support\NotificationDraftHistoryStore;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FlightDisruptionNotificationTool extends Component
{
    public string $category = 'flight';

    public string $disruptionType = 'delay';

    public string $clientName = '';

    public string $flightNumber = '';

    public string $serviceName = '';

    public string $reason = '';

    public string $newDateTime = '';

    public string $delayDuration = '';

    public ?string $generatedMessage = null;

    public ?string $apiError = null;

    public ?string $userInputError = null;

    /**
     * @var array<int, array<string, string>>
     */
    public array $history = [];

    public ?string $activeHistoryId = null;

    public function mount(): void
    {
        $this->history = $this->historyStore()->all();
    }

    public function updatedCategory(string $value): void
    {
        if ($value === BookingCategory::Flight->value) {
            $this->serviceName = '';
        } else {
            $this->flightNumber = '';
        }

        $this->resetResultState();
    }

    public function updatedDisruptionType(string $value): void
    {
        if ($value === DisruptionType::Cancellation->value) {
            $this->newDateTime = '';
            $this->delayDuration = '';
        }

        if ($value === DisruptionType::Reschedule->value) {
            $this->delayDuration = '';
        }

        $this->resetResultState();
    }

    public function generate(GenerateFlightDisruptionNotification $generator): void
    {
        $this->resetResultState();

        $validated = $this->validate($this->rules(), [], $this->validationAttributes());
        $data = FlightDisruptionNotificationData::fromValidated($validated);

        try {
            $result = $generator->handle($data);
        } catch (AnthropicRequestException $exception) {
            $this->apiError = $exception->getMessage();

            return;
        } catch (\Throwable) {
            $this->apiError = 'Something went wrong while generating the notification. Please try again.';

            return;
        }

        if (! $result->successful) {
            $this->userInputError = $result->invalidReason ?? 'The provided details could not be turned into a valid notification.';

            return;
        }

        $this->generatedMessage = $result->message;

        $entry = $this->historyStore()->push($data, $result->message);
        $this->history = $this->historyStore()->all();
        $this->activeHistoryId = $entry['id'];
    }

    public function showHistoryItem(string $historyId): void
    {
        $entry = $this->historyStore()->find($historyId);

        if ($entry === null) {
            return;
        }

        $this->resetResultState();
        $this->generatedMessage = $entry['message'];
        $this->activeHistoryId = $historyId;
    }

    public function clearHistory(): void
    {
        $this->historyStore()->clear();

        $this->history = [];
        $this->activeHistoryId = null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'category' => ['required', Rule::enum(BookingCategory::class)],
            'disruptionType' => ['required', Rule::enum(DisruptionType::class)],
            'clientName' => ['required', 'string', 'max:120'],
            'flightNumber' => [
                Rule::requiredIf(fn (): bool => $this->category === BookingCategory::Flight->value),
                'nullable',
                'string',
                'max:50',
            ],
            'serviceName' => [
                Rule::requiredIf(fn (): bool => $this->category !== BookingCategory::Flight->value),
                'nullable',
                'string',
                'max:120',
            ],
            'reason' => ['nullable', 'string', 'max:400'],
            'newDateTime' => [
                Rule::requiredIf(fn (): bool => $this->disruptionType === DisruptionType::Reschedule->value),
                'nullable',
                'date',
            ],
            'delayDuration' => [
                Rule::requiredIf(fn (): bool => $this->disruptionType === DisruptionType::Delay->value && $this->newDateTime === ''),
                'nullable',
                'string',
                'max:80',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function validationAttributes(): array
    {
        return [
            'clientName' => 'client name',
            'flightNumber' => 'flight number',
            'serviceName' => 'service name',
            'newDateTime' => 'new date and time',
            'delayDuration' => 'delay duration',
            'disruptionType' => 'disruption type',
        ];
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function categoryOptions(): array
    {
        return array_map(
            fn (BookingCategory $category): array => [
                'value' => $category->value,
                'label' => $category->label(),
            ],
            BookingCategory::cases(),
        );
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function disruptionOptions(): array
    {
        return array_map(
            fn (DisruptionType $type): array => [
                'value' => $type->value,
                'label' => $type->label(),
            ],
            DisruptionType::cases(),
        );
    }

    public function serviceFieldLabel(): string
    {
        return BookingCategory::from($this->category)->serviceFieldLabel();
    }

    public function render()
    {
        return view('livewire.flight-disruption-notification-tool', [
            'categoryOptions' => $this->categoryOptions(),
            'disruptionOptions' => $this->disruptionOptions(),
            'serviceFieldLabel' => $this->serviceFieldLabel(),
        ]);
    }

    private function resetResultState(): void
    {
        $this->generatedMessage = null;
        $this->apiError = null;
        $this->userInputError = null;
    }

    private function historyStore(): NotificationDraftHistoryStore
    {
        return app(NotificationDraftHistoryStore::class);
    }
}
