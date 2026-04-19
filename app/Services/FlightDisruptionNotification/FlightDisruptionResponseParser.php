<?php

namespace App\Services\FlightDisruptionNotification;

use RuntimeException;

class FlightDisruptionResponseParser
{
    public function parse(string $response): NotificationGenerationResult
    {
        if (preg_match('/<notification>\s*(.*?)\s*<\/notification>/s', $response, $matches) === 1) {
            return NotificationGenerationResult::success(trim($matches[1]));
        }

        if (preg_match('/<invalid-input>\s*(.*?)\s*<\/invalid-input>/s', $response, $matches) === 1) {
            return NotificationGenerationResult::invalid(trim($matches[1]));
        }

        throw new RuntimeException('The AI service returned an unexpected response. Please try again.');
    }
}
