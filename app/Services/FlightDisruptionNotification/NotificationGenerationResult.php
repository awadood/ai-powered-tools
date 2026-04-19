<?php

namespace App\Services\FlightDisruptionNotification;

final readonly class NotificationGenerationResult
{
    private function __construct(
        public bool $successful,
        public ?string $message,
        public ?string $invalidReason,
    ) {
    }

    public static function success(string $message): self
    {
        return new self(true, $message, null);
    }

    public static function invalid(string $reason): self
    {
        return new self(false, null, $reason);
    }
}
