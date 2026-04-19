@extends('layouts.app', ['title' => 'AI Playground'])

@section('content')
    <main class="app-page pt-6">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="app-brand">
                <span class="app-brand-mark">
                    <i data-lucide="sparkles" class="h-5 w-5"></i>
                </span>
                <span class="min-w-0">
                    <span class="app-brand-kicker block">Laravel AI Tools Demo</span>
                    <span class="app-brand-title block">AI Playground</span>
                </span>
            </a>

            <div class="flex flex-wrap items-center gap-3">
                <span class="app-pill border-pink-300/30 bg-pink-400/10 text-pink-600 dark:text-pink-100">Playful gallery</span>
                <span class="app-pill">8 tools</span>
                @include('partials.theme-switcher')
            </div>
        </div>

        <section
            x-data="{ reveal: false }"
            x-init="setTimeout(() => reveal = true, 120)"
            class="grid items-start gap-8 lg:grid-cols-[1.15fr_0.85fr]"
        >
            <div
                class="app-panel-strong app-home-hero space-y-6 p-8"
                :class="reveal ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0'"
                x-transition.duration.500ms
            >
                <div class="flex flex-wrap items-center gap-3">
                    <span class="app-pill border-pink-300/30 bg-pink-400/10 text-pink-600 dark:text-pink-100">
                        <span class="h-2 w-2 rounded-full bg-pink-400"></span>
                        Playful demo gallery
                    </span>
                    <span class="app-pill border-emerald-400/25 bg-emerald-400/10 text-emerald-700 dark:text-emerald-200">
                        Laravel + Livewire + Tailwind + Flowbite + Alpine + Lucide
                    </span>
                </div>

                <div class="max-w-3xl space-y-4">
                    <p class="app-kicker">AI-Powered Workflow Playground</p>
                    <h1 class="app-heading max-w-2xl text-4xl leading-tight sm:text-5xl">
                        Explore a gallery of tools with a visual system that feels right in both light and dark mode.
                    </h1>
                    <p class="app-copy max-w-2xl text-base leading-8 sm:text-lg">
                        This space is designed to hold working tools and future concepts in one consistent product
                        shell. Live tools should feel production-ready, and placeholders should still feel like part
                        of the same application.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="#tool-gallery" class="app-button-primary">
                        Browse tools
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>
                    <button
                        type="button"
                        data-modal-target="stack-modal"
                        data-modal-toggle="stack-modal"
                        class="app-button-secondary"
                    >
                        <i data-lucide="layers-3" class="h-4 w-4"></i>
                        View stack
                    </button>
                </div>
            </div>

            <div
                class="grid gap-4 sm:grid-cols-2"
                :class="reveal ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                x-transition.duration.700ms
            >
                <article class="app-stat-card">
                    <p class="app-kicker text-cyan-600 dark:text-cyan-200">Ready now</p>
                    <p class="app-heading mt-3 text-4xl">8</p>
                    <p class="app-copy-muted mt-2 text-sm leading-6">A gallery that can host live tools and placeholders without feeling split apart.</p>
                </article>

                <article class="app-stat-card">
                    <p class="app-kicker text-fuchsia-600 dark:text-fuchsia-200">Design direction</p>
                    <p class="app-heading mt-3 text-3xl">Warm, clear, playful</p>
                    <p class="app-copy-muted mt-2 text-sm leading-6">Rounded surfaces, layered cards, and color accents tuned for readability first.</p>
                </article>

                <article class="app-stat-card">
                    <p class="app-kicker text-amber-600 dark:text-amber-200">Interaction model</p>
                    <p class="app-heading mt-3 text-2xl">Server-driven UI</p>
                    <p class="app-copy-muted mt-2 text-sm leading-6">Laravel and Livewire keep the flow simple while Alpine handles small interactions cleanly.</p>
                </article>

                <article class="app-stat-card">
                    <p class="app-kicker text-emerald-600 dark:text-emerald-200">Theme behavior</p>
                    <p class="app-heading mt-3 text-2xl">System by default</p>
                    <p class="app-copy-muted mt-2 text-sm leading-6">The interface follows browser preference by default, and the inline toggle can override it any time.</p>
                </article>
            </div>
        </section>

        <livewire:tool-gallery :tools="$tools" />

        <div
            id="stack-modal"
            tabindex="-1"
            aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden p-4 md:inset-0"
        >
            <div class="relative max-h-full w-full max-w-2xl">
                <div class="app-modal">
                    <div class="flex items-center justify-between border-b px-6 py-5" style="border-color: var(--border-soft);">
                        <div>
                            <p class="app-kicker text-pink-600 dark:text-pink-200">Current stack</p>
                            <h3 class="app-heading mt-1 text-2xl">Why this setup works</h3>
                        </div>
                        <button type="button" data-modal-hide="stack-modal" class="app-button-secondary px-3 py-2">
                            <i data-lucide="x" class="h-4 w-4"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="space-y-4 px-6 py-6 text-sm leading-7">
                        <p class="app-copy">
                            Laravel handles routing and backend structure, Livewire gives us server-driven UI,
                            Tailwind and Flowbite cover layout and interactive building blocks, Alpine keeps the
                            micro-interactions light, and Lucide supplies consistent icons.
                        </p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="app-panel-muted p-4">
                                <p class="app-heading text-base">Fast iteration</p>
                                <p class="app-copy-muted mt-2">Placeholder pages can evolve into real tools without changing the navigation model.</p>
                            </div>
                            <div class="app-panel-muted p-4">
                                <p class="app-heading text-base">Balanced complexity</p>
                                <p class="app-copy-muted mt-2">Interactive touches stay light while the app remains firmly Laravel-first.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
