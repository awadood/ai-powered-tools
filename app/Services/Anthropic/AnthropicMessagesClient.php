<?php

namespace App\Services\Anthropic;

use Anthropic\Client;
use Anthropic\Core\Exceptions\APIConnectionException;
use Anthropic\Core\Exceptions\APIStatusException;
use Anthropic\Core\Exceptions\RateLimitException;
use Anthropic\Messages\TextBlock;

class AnthropicMessagesClient
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    public function generateText(string $systemPrompt, string $userPrompt): string
    {
        $apiKey = (string) config('services.anthropic.key');

        if ($apiKey === '') {
            throw new AnthropicRequestException('The AI service is not configured yet. Please add your Anthropic API key and try again.');
        }

        try {
            $message = $this->client->messages->create(
                maxTokens: (int) config('services.anthropic.max_tokens', 700),
                messages: [
                    [
                        'role' => 'user',
                        'content' => $userPrompt,
                    ],
                ],
                model: (string) config('services.anthropic.model'),
                system: $systemPrompt,
            );
        } catch (RateLimitException) {
            throw new AnthropicRequestException('The AI service is busy right now. Please wait a moment and try again.');
        } catch (APIConnectionException) {
            throw new AnthropicRequestException('The AI service could not be reached. Please try again shortly.');
        } catch (APIStatusException $exception) {
            throw new AnthropicRequestException($this->friendlyErrorMessage($exception->getStatusCode()));
        }

        $text = collect($message->content)
            ->filter(fn (mixed $block): bool => $block instanceof TextBlock)
            ->map(fn (TextBlock $block): string => $block->text)
            ->filter()
            ->implode("\n");

        if ($text === '') {
            throw new AnthropicRequestException('The AI service returned an empty response. Please try again.');
        }

        return trim($text);
    }

    private function friendlyErrorMessage(int $statusCode): string
    {
        return match ($statusCode) {
            400 => 'The AI service could not process this request. Please review the details and try again.',
            401, 403 => 'The AI service credentials appear to be invalid. Please check the Anthropic configuration.',
            404 => 'The configured AI model or endpoint could not be found. Please review the Anthropic settings.',
            408 => 'The AI service took too long to respond. Please try again.',
            429 => 'The AI service is busy right now. Please wait a moment and try again.',
            default => 'The AI service is temporarily unavailable. Please try again shortly.',
        };
    }
}
