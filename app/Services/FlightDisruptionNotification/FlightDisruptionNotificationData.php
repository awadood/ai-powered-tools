<?php

namespace App\Services\FlightDisruptionNotification;

use App\Enums\BookingCategory;
use App\Enums\DisruptionType;
use Carbon\Carbon;

final readonly class FlightDisruptionNotificationData
{
    public function __construct(
        public BookingCategory $category,
        public DisruptionType $disruptionType,
        public string $clientName,
        public ?string $flightNumber,
        public ?string $serviceName,
        public ?string $reason,
        public ?string $newDateTime,
        public ?string $delayDuration,
    ) {
    }

    /**
     * @param array<string, mixed> $validated
     */
    public static function fromValidated(array $validated): self
    {
        $newDateTime = isset($validated['newDateTime']) && $validated['newDateTime'] !== ''
            ? Carbon::parse((string) $validated['newDateTime'])->format('F j, Y \a\t g:i A')
            : null;

        return new self(
            category: BookingCategory::from((string) $validated['category']),
            disruptionType: DisruptionType::from((string) $validated['disruptionType']),
            clientName: trim((string) $validated['clientName']),
            flightNumber: self::nullableString($validated['flightNumber'] ?? null),
            serviceName: self::nullableString($validated['serviceName'] ?? null),
            reason: self::nullableString($validated['reason'] ?? null),
            newDateTime: $newDateTime,
            delayDuration: self::nullableString($validated['delayDuration'] ?? null),
        );
    }

    public function categoryLabel(): string
    {
        return $this->category->label();
    }

    public function disruptionLabel(): string
    {
        return $this->disruptionType->label();
    }

    public function referenceLabel(): string
    {
        return match ($this->category) {
            BookingCategory::Flight => 'Flight number',
            BookingCategory::HotelServices, BookingCategory::CarBookingChanges => 'Service name',
        };
    }

    public function referenceValue(): ?string
    {
        return match ($this->category) {
            BookingCategory::Flight => $this->flightNumber,
            BookingCategory::HotelServices, BookingCategory::CarBookingChanges => $this->serviceName,
        };
    }

    private static function nullableString(mixed $value): ?string
    {
        $value = is_string($value) ? trim($value) : null;

        return $value === '' ? null : $value;
    }
}
