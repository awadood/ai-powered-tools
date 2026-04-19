@extends('layouts.app', ['title' => 'Flight Disruption Notification'])

@section('content')
    <main class="app-page pt-6">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="app-button-secondary">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Back to gallery
            </a>

            <div class="flex flex-wrap items-center gap-3">
                <span class="app-pill border-emerald-400/25 bg-emerald-400/10 text-emerald-700 dark:text-emerald-200">Live tool</span>
                <span class="app-pill">English only</span>
                @include('partials.theme-switcher')
            </div>
        </div>

        <section class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="app-panel-strong app-tool-hero p-8">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="app-pill border-sky-300/25 bg-sky-300/10 text-sky-700 dark:text-sky-100">
                        <span class="h-2 w-2 rounded-full bg-sky-400"></span>
                        Customer notification generator
                    </span>
                    <span class="app-pill border-pink-300/25 bg-pink-300/10 text-pink-700 dark:text-pink-100">
                        Operations · Travel support
                    </span>
                </div>

                <div class="mt-6 max-w-3xl space-y-4">
                    <p class="app-kicker">Flight disruption workflow</p>
                    <h1 class="app-heading text-4xl leading-tight sm:text-5xl">Flight Disruption Notification</h1>
                    <p class="app-copy max-w-2xl text-base leading-8 sm:text-lg">
                        Turn disruption details into a clean, copy-ready customer notification for flights, hotel
                        services, or car booking changes. The form validates key inputs locally, then produces a
                        polished message that can be copied back into your support process.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <article class="app-stat-card">
                        <p class="app-kicker">Input model</p>
                        <p class="app-heading mt-3 text-xl">Required + optional</p>
                    </article>
                    <article class="app-stat-card">
                        <p class="app-kicker">Output</p>
                        <p class="app-heading mt-3 text-xl">Copy-ready message</p>
                    </article>
                    <article class="app-stat-card">
                        <p class="app-kicker">Brand</p>
                        <p class="app-heading mt-3 text-xl">{{ config('flight-disruption-notification.brand_name') }}</p>
                    </article>
                </div>
            </div>

            <aside class="space-y-6">
                <section class="app-panel p-6">
                    <p class="app-kicker text-pink-600 dark:text-pink-200">How it works</p>
                    <ul class="mt-4 space-y-3 text-sm leading-7">
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Choose the booking category and disruption type first.
                        </li>
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Fill the required facts. The form reveals only the fields that matter.
                        </li>
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Generate a professional notification or get a clear user-friendly error.
                        </li>
                    </ul>
                </section>

                <section class="app-panel p-6">
                    <p class="app-kicker text-sky-600 dark:text-sky-200">Included use cases</p>
                    <div class="mt-4 grid gap-3">
                        <div class="app-panel-muted px-4 py-4">
                            <p class="app-heading text-base">Flight disruptions</p>
                            <p class="app-copy-muted mt-1 text-sm leading-6">Cancellation, reschedule, or delay notices with flight number support.</p>
                        </div>
                        <div class="app-panel-muted px-4 py-4">
                            <p class="app-heading text-base">Hotel services</p>
                            <p class="app-copy-muted mt-1 text-sm leading-6">Airport shuttle or similar service changes with service-specific wording.</p>
                        </div>
                        <div class="app-panel-muted px-4 py-4">
                            <p class="app-heading text-base">Car booking changes</p>
                            <p class="app-copy-muted mt-1 text-sm leading-6">Transfer and driver-service updates with the same copy-ready output style.</p>
                        </div>
                    </div>
                </section>
            </aside>
        </section>

        <livewire:flight-disruption-notification-tool />
    </main>
@endsection
