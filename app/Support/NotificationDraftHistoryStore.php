<?php

namespace App\Support;

use App\Services\FlightDisruptionNotification\FlightDisruptionNotificationData;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;

class NotificationDraftHistoryStore
{
    private const SESSION_KEY = 'tools.flight_disruption_notification.history';

    private const MAX_ITEMS = 8;

    public function __construct(
        private readonly Session $session,
    ) {
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function all(): array
    {
        $history = $this->session->get(self::SESSION_KEY, []);

        return is_array($history) ? array_values($history) : [];
    }

    /**
     * @return array<string, string>
     */
    public function push(FlightDisruptionNotificationData $data, string $message): array
    {
        $entry = [
            'id' => (string) Str::ulid(),
            'subject' => $this->extractSubject($message),
            'category' => $data->categoryLabel(),
            'disruption' => $data->disruptionLabel(),
            'client_name' => $data->clientName,
            'reference' => $data->referenceValue() ?? $data->referenceLabel(),
            'message' => $message,
            'created_at' => now()->toIso8601String(),
            'created_at_human' => now()->format('M j, Y · g:i A'),
        ];

        $history = $this->all();
        array_unshift($history, $entry);
        $history = array_slice($history, 0, self::MAX_ITEMS);

        $this->session->put(self::SESSION_KEY, $history);

        return $entry;
    }

    /**
     * @return array<string, string>|null
     */
    public function find(string $id): ?array
    {
        foreach ($this->all() as $entry) {
            if (($entry['id'] ?? null) === $id) {
                return $entry;
            }
        }

        return null;
    }

    public function clear(): void
    {
        $this->session->forget(self::SESSION_KEY);
    }

    private function extractSubject(string $message): string
    {
        $firstLine = trim((string) Str::of($message)->before("\n"));

        return Str::startsWith($firstLine, 'SUBJECT:')
            ? trim((string) Str::after($firstLine, 'SUBJECT:'))
            : $firstLine;
    }
}
