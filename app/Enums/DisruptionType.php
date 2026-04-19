<?php

namespace App\Enums;

enum DisruptionType: string
{
    case Cancellation = 'cancellation';
    case Reschedule = 'reschedule';
    case Delay = 'delay';

    public function label(): string
    {
        return match ($this) {
            self::Cancellation => 'Cancellation',
            self::Reschedule => 'Reschedule',
            self::Delay => 'Delay',
        };
    }
}
