@extends('layouts.app', ['title' => $tool['name'].' Placeholder'])

@section('content')
    <main class="mx-auto max-w-6xl px-6 py-8 sm:px-8 lg:px-12">
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-medium text-white transition hover:border-sky-300/40 hover:bg-white/10"
            >
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Back to gallery
            </a>

            <span
                class="inline-flex rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.35em]"
                style="border-color: {{ $tool['accent'] }}55; color: {{ $tool['accent'] }};"
            >
                {{ $tool['status'] }}
            </span>
        </div>

        <section class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr]">
            <div
                class="overflow-hidden rounded-[2.5rem] border p-8 shadow-[0_28px_100px_-40px_rgba(15,23,42,0.9)]"
                style="
                    border-color: {{ $tool['accent'] }}33;
                    background-image:
                        linear-gradient(180deg, rgba(15, 23, 42, 0.88), rgba(2, 6, 23, 0.98)),
                        radial-gradient(circle at top left, {{ $tool['accent'] }}66, transparent 42%);
                "
            >
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-300/80">{{ $tool['category'] }}</p>
                        <h1 class="mt-3 text-4xl font-semibold text-white sm:text-5xl">{{ $tool['name'] }}</h1>
                        <p class="mt-4 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">{{ $tool['blurb'] }}</p>
                    </div>

                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-[1.75rem] border border-white/10 bg-white/10 text-white"
                        style="box-shadow: 0 18px 45px -24px {{ $tool['accent'] }};"
                    >
                        <i data-lucide="{{ $tool['icon'] }}" class="h-8 w-8"></i>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <article class="rounded-[1.75rem] border border-white/10 bg-white/6 p-4">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Current state</p>
                        <p class="mt-3 text-xl font-semibold text-white">Placeholder page</p>
                    </article>
                    <article class="rounded-[1.75rem] border border-white/10 bg-white/6 p-4">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Planned focus</p>
                        <p class="mt-3 text-xl font-semibold text-white">{{ $tool['highlight'] }}</p>
                    </article>
                    <article class="rounded-[1.75rem] border border-white/10 bg-white/6 p-4">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Route ready</p>
                        <p class="mt-3 text-xl font-semibold text-white">Yes</p>
                    </article>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <button
                        type="button"
                        data-modal-target="placeholder-modal"
                        data-modal-toggle="placeholder-modal"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-950 transition hover:scale-[1.01]"
                    >
                        See roadmap note
                        <i data-lucide="map" class="h-4 w-4"></i>
                    </button>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-5 py-3 text-sm font-medium text-slate-200">
                        <i data-lucide="wand" class="h-4 w-4"></i>
                        Real implementation comes later
                    </span>
                </div>

                <div class="mt-10 rounded-[2rem] border border-white/10 bg-slate-950/50 p-5">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Preview panel</p>
                            <p class="mt-1 text-lg font-semibold text-white">Future workspace shell</p>
                        </div>
                        <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-slate-300">Prototype</span>
                    </div>

                    <div class="grid gap-4 md:grid-cols-[0.92fr_1.08fr]">
                        <div class="space-y-3 rounded-[1.5rem] border border-white/10 bg-white/5 p-4">
                            <div class="h-3 w-24 rounded-full bg-white/15"></div>
                            <div class="h-20 rounded-[1.25rem] bg-white/8"></div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="h-16 rounded-[1.25rem] bg-white/8"></div>
                                <div class="h-16 rounded-[1.25rem] bg-white/8"></div>
                            </div>
                        </div>

                        <div class="rounded-[1.5rem] border border-dashed border-white/15 bg-white/5 p-4">
                            <p class="text-sm leading-7 text-slate-300">
                                This route exists so navigation, styling, and page structure are already in place.
                                When the real tool is built, this shell can become its dedicated interface instead of
                                starting from scratch.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <section class="rounded-[2rem] border border-white/10 bg-white/6 p-6 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-sky-200/80">What changes later</p>
                    <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-300">
                        <li class="flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-300"></i>
                            Replace the preview shell with the real tool workflow.
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-300"></i>
                            Keep the route, headline, and navigation unchanged.
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-emerald-300"></i>
                            Reuse this page scaffold for status panels, controls, and results.
                        </li>
                    </ul>
                </section>

                <section class="rounded-[2rem] border border-white/10 bg-white/6 p-6 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-pink-200/80">More demos</p>
                    <div class="mt-4 grid gap-3">
                        @foreach ($relatedTools as $relatedTool)
                            <a
                                href="{{ route('tools.show', $relatedTool['slug']) }}"
                                class="flex items-center justify-between rounded-[1.5rem] border border-white/10 bg-white/5 px-4 py-4 text-sm transition hover:border-white/20 hover:bg-white/10"
                            >
                                <span class="flex items-center gap-3">
                                    <i data-lucide="{{ $relatedTool['icon'] }}" class="h-4 w-4 text-slate-200"></i>
                                    <span class="font-medium text-white">{{ $relatedTool['name'] }}</span>
                                </span>
                                <i data-lucide="arrow-right" class="h-4 w-4 text-slate-400"></i>
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
                <div class="relative rounded-[2rem] border border-white/15 bg-slate-900/95 shadow-2xl shadow-slate-950/60">
                    <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-pink-200/80">Roadmap note</p>
                            <h3 class="mt-1 text-2xl font-semibold text-white">{{ $tool['name'] }} is not implemented yet</h3>
                        </div>
                        <button
                            type="button"
                            data-modal-hide="placeholder-modal"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white"
                        >
                            <i data-lucide="x" class="h-4 w-4"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="space-y-4 px-6 py-6 text-sm leading-7 text-slate-300">
                        <p>
                            This page is a route-backed placeholder. The card launch flow, styling, and page
                            structure are real now so the future tool only needs its actual feature implementation.
                        </p>
                        <p>
                            The current priority was to establish the app shell and a launchable gallery, not to
                            guess tool behavior too early.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
