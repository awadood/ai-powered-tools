<section id="tool-gallery" class="py-14">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div class="space-y-2">
            <p class="app-kicker text-sky-600 dark:text-sky-200">Tool gallery</p>
            <h2 class="app-heading text-3xl">Launch a tool from the gallery</h2>
        </div>

        <p class="app-copy-muted max-w-xl text-sm leading-7">
            Categories stay filterable client-side with Alpine, but the presentation is now deliberately shared
            between light and dark mode instead of feeling like two separate interfaces.
        </p>
    </div>

    <div x-data="{ activeCategory: 'All' }" class="space-y-6">
        <div class="flex flex-wrap gap-3">
            @foreach ($categories as $category)
                <button
                    type="button"
                    @click="activeCategory = '{{ $category }}'"
                    class="app-filter"
                    :data-active="activeCategory === '{{ $category }}'"
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
                    class="group app-tool-card"
                    style="--tool-accent: {{ $tool['accent'] }};"
                >
                    <div class="absolute inset-x-5 top-0 h-px bg-gradient-to-r from-transparent via-white/60 to-transparent opacity-80 dark:via-white/40"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div
                            class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border"
                            style="
                                border-color: color-mix(in srgb, {{ $tool['accent'] }} 30%, transparent);
                                background: color-mix(in srgb, {{ $tool['accent'] }} 14%, var(--surface-2));
                                color: {{ $tool['accent'] }};
                                box-shadow: 0 12px 35px -20px {{ $tool['accent'] }};
                            "
                        >
                            <i data-lucide="{{ $tool['icon'] }}" class="h-6 w-6"></i>
                        </div>

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.25em]"
                            style="
                                background-color: color-mix(in srgb, {{ $tool['accent'] }} 16%, transparent);
                                color: {{ $tool['accent'] }};
                            "
                        >
                            {{ $tool['status'] }}
                        </span>
                    </div>

                    <div class="mt-8 space-y-3">
                        <div class="space-y-1">
                            <p class="app-kicker" style="color: color-mix(in srgb, var(--text-soft) 84%, {{ $tool['accent'] }} 16%);">{{ $tool['category'] }}</p>
                            <h3 class="app-heading text-2xl">{{ $tool['name'] }}</h3>
                        </div>

                        <p class="app-copy-muted min-h-24 text-sm leading-7">
                            {{ $tool['blurb'] }}
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t pt-4 text-sm" style="border-color: var(--border-soft);">
                        <div>
                            <p class="app-kicker">Focus</p>
                            <p class="app-heading mt-1 text-base">{{ $tool['highlight'] }}</p>
                        </div>
                        <span class="inline-flex items-center gap-2 font-semibold" style="color: {{ $tool['accent'] }};">
                            Open
                            <i data-lucide="arrow-up-right" class="h-4 w-4 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
