<?php

namespace App\Providers;

use Anthropic\Client as AnthropicClient;
use Anthropic\RequestOptions;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AnthropicClient::class, function (): AnthropicClient {
            $baseUrl = rtrim((string) config('services.anthropic.base_url', 'https://api.anthropic.com'), '/');

            if (str_ends_with($baseUrl, '/v1')) {
                $baseUrl = substr($baseUrl, 0, -3);
            }

            return new AnthropicClient(
                apiKey: (string) config('services.anthropic.key'),
                baseUrl: $baseUrl,
                requestOptions: RequestOptions::with(
                    timeout: (float) config('services.anthropic.timeout', 30),
                    maxRetries: (int) config('services.anthropic.max_retries', 2),
                    extraHeaders: [
                        'anthropic-version' => (string) config('services.anthropic.version', '2023-06-01'),
                    ],
                ),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
