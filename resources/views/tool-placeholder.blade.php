@extends('layouts.app', ['title' => $tool['name'].' Placeholder'])

@section('content')
    <main class="app-page pt-6">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="app-button-secondary">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Back to gallery
            </a>

            <div class="flex flex-wrap items-center gap-3">
                <span
                    class="app-pill"
                    style="
                        border-color: color-mix(in srgb, {{ $tool['accent'] }} 28%, var(--border-soft));
                        background: color-mix(in srgb, {{ $tool['accent'] }} 10%, var(--surface-2));
                        color: {{ $tool['accent'] }};
                    "
                >
                    {{ $tool['status'] }}
                </span>
                @include('partials.theme-switcher')
            </div>
        </div>

        <section class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="app-panel-strong p-8" style="background-image: linear-gradient(180deg, var(--tool-card-start), var(--tool-card-end)), radial-gradient(circle at top left, {{ $tool['accent'] }}33, transparent 42%);">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="max-w-2xl">
                        <p class="app-kicker">{{ $tool['category'] }}</p>
                        <h1 class="app-heading mt-3 text-4xl sm:text-5xl">{{ $tool['name'] }}</h1>
                        <p class="app-copy mt-4 max-w-2xl text-base leading-8 sm:text-lg">{{ $tool['blurb'] }}</p>
                    </div>

                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-[1.75rem] border"
                        style="
                            border-color: color-mix(in srgb, {{ $tool['accent'] }} 28%, var(--border-soft));
                            background: color-mix(in srgb, {{ $tool['accent'] }} 12%, var(--surface-2));
                            color: {{ $tool['accent'] }};
                            box-shadow: 0 18px 45px -24px {{ $tool['accent'] }};
                        "
                    >
                        <i data-lucide="{{ $tool['icon'] }}" class="h-8 w-8"></i>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <article class="app-stat-card">
                        <p class="app-kicker">Current state</p>
                        <p class="app-heading mt-3 text-xl">Placeholder page</p>
                    </article>
                    <article class="app-stat-card">
                        <p class="app-kicker">Planned focus</p>
                        <p class="app-heading mt-3 text-xl">{{ $tool['highlight'] }}</p>
                    </article>
                    <article class="app-stat-card">
                        <p class="app-kicker">Route ready</p>
                        <p class="app-heading mt-3 text-xl">Yes</p>
                    </article>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <button type="button" data-modal-target="placeholder-modal" data-modal-toggle="placeholder-modal" class="app-button-primary">
                        See roadmap note
                        <i data-lucide="map" class="h-4 w-4"></i>
                    </button>
                    <span class="app-button-secondary">
                        <i data-lucide="wand" class="h-4 w-4"></i>
                        Real implementation comes later
                    </span>
                </div>

                <div class="app-panel-muted mt-10 p-5">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <p class="app-kicker">Preview panel</p>
                            <p class="app-heading mt-1 text-lg">Future workspace shell</p>
                        </div>
                        <span class="app-pill px-3 py-1 text-xs">Prototype</span>
                    </div>

                    <div class="grid gap-4 md:grid-cols-[0.92fr_1.08fr]">
                        <div class="app-panel p-4">
                            <div class="space-y-3">
                                <div class="h-3 w-24 rounded-full" style="background: color-mix(in srgb, var(--text-soft) 24%, transparent);"></div>
                                <div class="h-20 rounded-[1.25rem]" style="background: color-mix(in srgb, var(--text-soft) 16%, transparent);"></div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="h-16 rounded-[1.25rem]" style="background: color-mix(in srgb, var(--text-soft) 16%, transparent);"></div>
                                    <div class="h-16 rounded-[1.25rem]" style="background: color-mix(in srgb, var(--text-soft) 16%, transparent);"></div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[1.5rem] border border-dashed p-4" style="border-color: var(--border-soft); background: var(--surface-2);">
                            <p class="app-copy text-sm leading-7">
                                This route exists so navigation, styling, and page structure are already in place.
                                When the real tool is built, this shell can become its dedicated interface instead of
                                starting from scratch.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <section class="app-panel p-6">
                    <p class="app-kicker text-sky-600 dark:text-sky-200">What changes later</p>
                    <ul class="mt-4 space-y-3 text-sm leading-7">
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Replace the preview shell with the real tool workflow.
                        </li>
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Keep the route, headline, and navigation unchanged.
                        </li>
                        <li class="app-copy flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-500"></i>
                            Reuse this page scaffold for status panels, controls, and results.
                        </li>
                    </ul>
                </section>

                <section class="app-panel p-6">
                    <p class="app-kicker text-pink-600 dark:text-pink-200">More demos</p>
                    <div class="mt-4 grid gap-3">
                        @foreach ($relatedTools as $relatedTool)
                            <a href="{{ route('tools.show', $relatedTool['slug']) }}" class="app-panel-muted flex items-center justify-between px-4 py-4 text-sm transition hover:-translate-y-0.5">
                                <span class="flex items-center gap-3">
                                    <i data-lucide="{{ $relatedTool['icon'] }}" class="h-4 w-4" style="color: {{ $relatedTool['accent'] }};"></i>
                                    <span class="app-heading text-base">{{ $relatedTool['name'] }}</span>
                                </span>
                                <i data-lucide="arrow-right" class="h-4 w-4 app-copy-muted"></i>
                            </a>
                        @endforeach
                    </div>
                </section>
            </aside>
        </section>

        <div
            id="placeholder-modal"
            tabindex="-1"
            aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden p-4 md:inset-0"
        >
            <div class="relative max-h-full w-full max-w-xl">
                <div class="app-modal">
                    <div class="flex items-center justify-between border-b px-6 py-5" style="border-color: var(--border-soft);">
                        <div>
                            <p class="app-kicker text-pink-600 dark:text-pink-200">Roadmap note</p>
                            <h3 class="app-heading mt-1 text-2xl">{{ $tool['name'] }} is not implemented yet</h3>
                        </div>
                        <button type="button" data-modal-hide="placeholder-modal" class="app-button-secondary px-3 py-2">
                            <i data-lucide="x" class="h-4 w-4"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="space-y-4 px-6 py-6 text-sm leading-7">
                        <p class="app-copy">
                            This page is a route-backed placeholder. The card launch flow, styling, and page
                            structure are real now so the future tool only needs its actual feature implementation.
                        </p>
                        <p class="app-copy">
                            The current priority was to establish the app shell and a launchable gallery without
                            forcing placeholder screens into a second-rate visual style.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
