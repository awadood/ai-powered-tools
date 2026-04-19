<section id="tool-gallery" class="py-14">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-sky-200/80">Tool gallery</p>
            <h2 class="mt-2 text-3xl font-semibold text-white">Pick a tool box to open its placeholder page</h2>
        </div>

        <p class="max-w-xl text-sm leading-7 text-slate-300">
            Categories are filterable client-side with Alpine so the gallery stays playful and quick while the
            underlying content remains easy to manage from one catalog.
        </p>
    </div>

    <div x-data="{ activeCategory: 'All' }" class="space-y-6">
        <div class="flex flex-wrap gap-3">
            @foreach ($categories as $category)
                <button
                    type="button"
                    @click="activeCategory = '{{ $category }}'"
                    class="rounded-full border px-4 py-2 text-sm font-medium transition"
                    :class="activeCategory === '{{ $category }}'
                        ? 'border-white bg-white text-slate-950'
                        : 'border-white/12 bg-white/5 text-slate-200 hover:border-pink-300/40 hover:bg-white/10'"
                >
                    {{ $category }}
                </button>
            @endforeach
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($tools as $tool)
                <a
                    href="{{ route('tools.show', $tool['slug']) }}"
                    x-cloak
                    x-show="activeCategory === 'All' || activeCategory === '{{ $tool['category'] }}'"
                    x-transition.opacity.scale.duration.250ms
                    class="group relative overflow-hidden rounded-[2rem] border p-5 shadow-[0_24px_60px_-32px_rgba(15,23,42,0.9)] transition duration-300 hover:-translate-y-1"
                    style="
                        border-color: {{ $tool['accent'] }}33;
                        background-image:
                            linear-gradient(180deg, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.98)),
                            radial-gradient(circle at top right, {{ $tool['accent'] }}88, transparent 48%);
                    "
                >
                    <div class="absolute inset-x-5 top-0 h-px bg-gradient-to-r from-transparent via-white/50 to-transparent opacity-70"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div
                            class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-white"
                            style="box-shadow: 0 12px 35px -20px {{ $tool['accent'] }};"
                        >
                            <i data-lucide="{{ $tool['icon'] }}" class="h-6 w-6"></i>
                        </div>

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.25em]"
                            style="background-color: {{ $tool['accent'] }}22; color: {{ $tool['accent'] }};"
                        >
                            {{ $tool['status'] }}
                        </span>
                    </div>

                    <div class="mt-8 space-y-3">
                        <div class="space-y-1">
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-300/80">{{ $tool['category'] }}</p>
                            <h3 class="text-2xl font-semibold text-white transition group-hover:text-white/95">{{ $tool['name'] }}</h3>
                        </div>

                        <p class="min-h-24 text-sm leading-7 text-slate-300">
                            {{ $tool['blurb'] }}
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-white/10 pt-4 text-sm">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Focus</p>
                            <p class="mt-1 font-medium text-white">{{ $tool['highlight'] }}</p>
                        </div>
                        <span class="inline-flex items-center gap-2 font-semibold text-white">
                            Open
                            <i data-lucide="arrow-up-right" class="h-4 w-4 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
