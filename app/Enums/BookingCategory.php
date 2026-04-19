<?php

namespace App\Enums;

enum BookingCategory: string
{
    case Flight = 'flight';
    case HotelServices = 'hotel_services';
    case CarBookingChanges = 'car_booking_changes';

    public function label(): string
    {
        return match ($this) {
            self::Flight => 'Flight',
            self::HotelServices => 'Hotel services',
            self::CarBookingChanges => 'Car booking changes',
        };
    }

    public function serviceFieldLabel(): string
    {
        return match ($this) {
            self::Flight => 'Service name',
            self::HotelServices => 'Hotel service name',
            self::CarBookingChanges => 'Car service name',
        };
    }
}
