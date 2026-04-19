@extends('layouts.app', ['title' => 'AI Playground'])

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-8 sm:px-8 lg:px-12">
        <nav class="mb-10 flex flex-col gap-4 rounded-[2rem] border border-white/10 bg-white/5 px-5 py-4 shadow-2xl shadow-slate-950/30 backdrop-blur md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-950 shadow-lg shadow-pink-500/20">
                    <i data-lucide="sparkles" class="h-6 w-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-sky-200/80">Laravel AI Tools Demo</p>
                    <h1 class="text-xl font-semibold text-white">AI Playground</h1>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center rounded-full border border-emerald-400/30 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                    Laravel + Livewire + Tailwind + Flowbite + Alpine + Lucide
                </span>
                <button
                    type="button"
                    data-modal-target="stack-modal"
                    data-modal-toggle="stack-modal"
                    class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:border-pink-300/40 hover:bg-white/15"
                >
                    <i data-lucide="layers-3" class="h-4 w-4"></i>
                    View stack
                </button>
            </div>
        </nav>

        <section
            x-data="{ reveal: false }"
            x-init="setTimeout(() => reveal = true, 120)"
            class="grid items-start gap-8 lg:grid-cols-[1.15fr_0.85fr]"
        >
            <div
                class="space-y-6 rounded-[2.5rem] border border-white/10 bg-white/6 p-8 shadow-[0_32px_120px_-40px_rgba(236,72,153,0.6)] backdrop-blur"
                :class="reveal ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0'"
                x-transition.duration.500ms
            >
                <div class="inline-flex items-center gap-2 rounded-full border border-pink-300/30 bg-pink-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-pink-100">
                    <span class="h-2 w-2 rounded-full bg-pink-300"></span>
                    Playful demo gallery
                </div>

                <div class="max-w-3xl space-y-4">
                    <h2 class="max-w-2xl text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Click into eight imaginary AI tools while the real ones catch up.
                    </h2>
                    <p class="max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
                        This landing page is the launchpad for a growing collection of AI-powered utilities. The
                        cards below already route to dedicated placeholder screens, so we can swap in real tools
                        later without redesigning the entry flow.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a
                        href="#tool-gallery"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-950 transition hover:scale-[1.01]"
                    >
                        Browse demo tools
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>
                    <button
                        type="button"
                        data-modal-target="stack-modal"
                        data-modal-toggle="stack-modal"
                        class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-transparent px-5 py-3 text-sm font-semibold text-white transition hover:border-sky-300/40 hover:bg-white/6"
                    >
                        Why this stack
                        <i data-lucide="rocket" class="h-4 w-4"></i>
                    </button>
                </div>
            </div>

            <div
                class="grid gap-4 sm:grid-cols-2"
                :class="reveal ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                x-transition.duration.700ms
            >
                <article class="rounded-[2rem] border border-cyan-300/15 bg-cyan-300/10 p-5 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100/80">Ready now</p>
                    <p class="mt-3 text-4xl font-semibold text-white">8</p>
                    <p class="mt-2 text-sm leading-6 text-cyan-50/80">Clickable launch cards with dedicated placeholder pages.</p>
                </article>

                <article class="rounded-[2rem] border border-fuchsia-300/15 bg-fuchsia-300/10 p-5 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-fuchsia-100/80">UI mood</p>
                    <p class="mt-3 text-3xl font-semibold text-white">Playful</p>
                    <p class="mt-2 text-sm leading-6 text-fuchsia-50/80">Soft gradients, rounded cards, and gallery-style motion cues.</p>
                </article>

                <article class="rounded-[2rem] border border-amber-300/15 bg-amber-300/10 p-5 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-100/80">Built with</p>
                    <p class="mt-3 text-2xl font-semibold text-white">Livewire + Alpine</p>
                    <p class="mt-2 text-sm leading-6 text-amber-50/80">Server-rendered Laravel pages with a light interactive layer.</p>
                </article>

                <article class="rounded-[2rem] border border-emerald-300/15 bg-emerald-300/10 p-5 backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-100/80">Next step</p>
                    <p class="mt-3 text-2xl font-semibold text-white">Swap placeholders</p>
                    <p class="mt-2 text-sm leading-6 text-emerald-50/80">Each route is ready to host a real tool when development starts.</p>
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
                <div class="relative rounded-[2rem] border border-white/15 bg-slate-900/95 shadow-2xl shadow-slate-950/60">
                    <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-pink-200/80">Current stack</p>
                            <h3 class="mt-1 text-2xl font-semibold text-white">Why this setup works</h3>
                        </div>
                        <button
                            type="button"
                            data-modal-hide="stack-modal"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white"
                        >
                            <i data-lucide="x" class="h-4 w-4"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="space-y-4 px-6 py-6 text-sm leading-7 text-slate-300">
                        <p>
                            Laravel handles routing and backend structure, Livewire gives us server-driven UI,
                            Tailwind and Flowbite cover layout and interactive building blocks, Alpine keeps the
                            micro-interactions light, and Lucide supplies consistent icons.
                        </p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="font-semibold text-white">Fast iteration</p>
                                <p class="mt-2 text-slate-300">Placeholder pages can turn into real tools without changing the navigation model.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="font-semibold text-white">Balanced complexity</p>
                                <p class="mt-2 text-slate-300">Interactive touches stay small and maintainable while the app stays Laravel-first.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
