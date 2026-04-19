<?php

namespace App\Services\FlightDisruptionNotification;

use App\Services\Anthropic\AnthropicMessagesClient;

class GenerateFlightDisruptionNotification
{
    public function __construct(
        private readonly AnthropicMessagesClient $anthropic,
        private readonly FlightDisruptionPromptFactory $promptFactory,
        private readonly FlightDisruptionResponseParser $parser,
    ) {
    }

    public function handle(FlightDisruptionNotificationData $data): NotificationGenerationResult
    {
        $response = $this->anthropic->generateText(
            systemPrompt: $this->promptFactory->systemPrompt(),
            userPrompt: $this->promptFactory->userPrompt($data),
        );

        return $this->parser->parse($response);
    }
}
