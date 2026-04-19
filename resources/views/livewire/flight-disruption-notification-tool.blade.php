<section class="py-12">
    <div class="grid gap-8 xl:grid-cols-[0.9fr_1.1fr]">
        <form wire:submit.prevent="generate" class="app-panel space-y-6 p-6 sm:p-7">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="app-kicker">Input details</p>
                    <h2 class="app-heading mt-1 text-2xl">Build the notification</h2>
                </div>
                <div class="app-pill">
                    <i data-lucide="sparkles" class="h-4 w-4"></i>
                    AI-assisted drafting
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <label class="space-y-2">
                    <span class="app-copy text-sm font-medium">Booking category</span>
                    <select wire:model.live="category" class="app-select">
                        @foreach ($categoryOptions as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                </label>

                <label class="space-y-2">
                    <span class="app-copy text-sm font-medium">Disruption type</span>
                    <select wire:model.live="disruptionType" class="app-select">
                        @foreach ($disruptionOptions as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                    @error('disruptionType') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                </label>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <label class="space-y-2">
                    <span class="app-copy text-sm font-medium">Client name</span>
                    <input wire:model.blur="clientName" type="text" placeholder="e.g. Abdul Wadood" class="app-field">
                    @error('clientName') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                </label>

                @if ($category === 'flight')
                    <label class="space-y-2">
                        <span class="app-copy text-sm font-medium">Flight number</span>
                        <input wire:model.blur="flightNumber" type="text" placeholder="e.g. EK-613" class="app-field">
                        @error('flightNumber') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                    </label>
                @else
                    <label class="space-y-2">
                        <span class="app-copy text-sm font-medium">{{ $serviceFieldLabel }}</span>
                        <input
                            wire:model.blur="serviceName"
                            type="text"
                            placeholder="{{ $category === 'hotel_services' ? 'e.g. Airport shuttle service' : 'e.g. Airport transfer' }}"
                            class="app-field"
                        >
                        @error('serviceName') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                    </label>
                @endif
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <label class="space-y-2">
                    <span class="app-copy text-sm font-medium">New date and time</span>
                    <input wire:model.blur="newDateTime" type="datetime-local" class="app-field">
                    <span class="app-copy-muted text-xs leading-6">Required for reschedules. Also acceptable for delays if you know the updated time.</span>
                    @error('newDateTime') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                </label>

                <label class="space-y-2">
                    <span class="app-copy text-sm font-medium">Delay duration</span>
                    <input wire:model.blur="delayDuration" type="text" placeholder="e.g. 45 minutes" class="app-field">
                    <span class="app-copy-muted text-xs leading-6">Required for delays if you do not provide the new date and time.</span>
                    @error('delayDuration') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
                </label>
            </div>

            <label class="space-y-2">
                <span class="app-copy text-sm font-medium">Reason</span>
                <textarea wire:model.blur="reason" rows="4" placeholder="Optional. e.g. operational issues, weather conditions, supplier constraints" class="app-textarea"></textarea>
                <span class="app-copy-muted text-xs leading-6">Keep this short. The message generator will only use facts you provide.</span>
                @error('reason') <span class="text-sm text-rose-500 dark:text-rose-300">{{ $message }}</span> @enderror
            </label>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="app-button-primary min-w-[13.75rem] justify-center disabled:cursor-not-allowed disabled:opacity-60"
                >
                    <span wire:loading.remove wire:target="generate" class="inline-flex min-w-[10.75rem] items-center justify-center gap-2 whitespace-nowrap">
                        <i data-lucide="wand" class="h-4 w-4"></i>
                        Generate notification
                    </span>
                    <span wire:loading wire:target="generate" class="inline-flex min-w-[10.75rem] items-center justify-center gap-2 whitespace-nowrap">
                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                            <path d="M22 12a10 10 0 0 0-10-10" stroke="currentColor" stroke-width="4" class="opacity-90"></path>
                        </svg>
                        Drafting...
                    </span>
                </button>

                <span class="app-copy-muted text-sm">
                    The final message will end with {{ config('flight-disruption-notification.brand_name') }}.
                </span>
            </div>
        </form>

        <div class="space-y-6">
            <section class="app-panel p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="app-kicker">Output</p>
                        <h2 class="app-heading mt-1 text-2xl">Generated notification</h2>
                    </div>
                    @if ($generatedMessage)
                        <div x-data="{ copied: false }" class="shrink-0">
                            <button
                                type="button"
                                @click="navigator.clipboard.writeText($refs.generatedText.innerText).then(() => { copied = true; setTimeout(() => copied = false, 1800); })"
                                class="app-button-secondary"
                            >
                                <i data-lucide="copy" class="h-4 w-4"></i>
                                <span x-show="!copied">Copy message</span>
                                <span x-show="copied" x-cloak>Copied</span>
                            </button>
                        </div>
                    @endif
                </div>

                @if ($apiError)
                    <div class="mt-5 rounded-[1.6rem] border border-amber-300/30 bg-amber-300/12 px-5 py-4 text-sm leading-7 text-amber-800 dark:text-amber-100">
                        <div class="flex gap-3">
                            <i data-lucide="triangle-alert" class="mt-1 h-4 w-4 shrink-0"></i>
                            <div>
                                <p class="font-semibold">AI service error</p>
                                <p class="mt-1">{{ $apiError }}</p>
                            </div>
                        </div>
                    </div>
                @elseif ($userInputError)
                    <div class="mt-5 rounded-[1.6rem] border border-rose-300/30 bg-rose-300/12 px-5 py-4 text-sm leading-7 text-rose-800 dark:text-rose-100">
                        <div class="flex gap-3">
                            <i data-lucide="shield-alert" class="mt-1 h-4 w-4 shrink-0"></i>
                            <div>
                                <p class="font-semibold">Input needs attention</p>
                                <p class="mt-1">{{ $userInputError }}</p>
                            </div>
                        </div>
                    </div>
                @elseif ($generatedMessage)
                    <div x-data class="mt-5 rounded-[1.6rem] border border-emerald-300/30 bg-emerald-300/10 p-1">
                        <div class="rounded-[1.35rem] border p-5" style="border-color: var(--border-soft); background: var(--surface-3);">
                            <pre x-ref="generatedText" class="whitespace-pre-wrap font-sans text-sm leading-7" style="color: var(--text-base);">{{ $generatedMessage }}</pre>
                        </div>
                    </div>
                @else
                    <div class="mt-5 rounded-[1.6rem] border border-dashed p-6" style="border-color: var(--border-soft); background: var(--surface-muted);">
                        <p class="app-copy-muted text-sm leading-7">
                            Your generated message will appear here after submission. The tool produces a concise,
                            formal notification that is ready to copy and paste into an email or support workflow.
                        </p>
                    </div>
                @endif
            </section>

            <section class="app-panel p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="app-kicker">Recent drafts</p>
                        <h2 class="app-heading mt-1 text-2xl">Previously generated messages</h2>
                    </div>

                    @if ($history !== [])
                        <button type="button" wire:click="clearHistory" class="app-button-secondary">
                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                            Clear
                        </button>
                    @endif
                </div>

                @if ($history === [])
                    <div class="mt-5 rounded-[1.6rem] border border-dashed p-6" style="border-color: var(--border-soft); background: var(--surface-muted);">
                        <p class="app-copy-muted text-sm leading-7">
                            Generated messages will be saved here for this browser session so you can revisit and
                            copy them later without re-entering the same details.
                        </p>
                    </div>
                @else
                    <div class="mt-5 space-y-3">
                        @foreach ($history as $item)
                            <article
                                class="rounded-[1.5rem] border p-4 transition"
                                style="
                                    border-color: {{ $activeHistoryId === $item['id'] ? 'rgba(56, 189, 248, 0.35)' : 'var(--border-soft)' }};
                                    background: {{ $activeHistoryId === $item['id'] ? 'color-mix(in srgb, rgb(56 189 248 / 0.12) 70%, var(--surface-2))' : 'var(--surface-muted)' }};
                                "
                            >
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div class="space-y-2">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="app-pill px-2.5 py-1 text-[11px] tracking-[0.22em]">{{ $item['category'] }}</span>
                                            <span class="app-pill px-2.5 py-1 text-[11px] tracking-[0.22em]">{{ $item['disruption'] }}</span>
                                        </div>
                                        <h3 class="app-heading text-lg">{{ $item['subject'] }}</h3>
                                        <p class="app-copy-muted text-sm">{{ $item['client_name'] }} · {{ $item['reference'] }}</p>
                                        <p class="app-kicker">{{ $item['created_at_human'] }}</p>
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" wire:click="showHistoryItem('{{ $item['id'] }}')" class="app-button-secondary">
                                            <i data-lucide="history" class="h-4 w-4"></i>
                                            View
                                        </button>

                                        <div x-data="{ copied: false }">
                                            <button
                                                type="button"
                                                @click="navigator.clipboard.writeText(@js($item['message'])).then(() => { copied = true; setTimeout(() => copied = false, 1800); })"
                                                class="app-button-secondary"
                                            >
                                                <i data-lucide="copy" class="h-4 w-4"></i>
                                                <span x-show="!copied">Copy</span>
                                                <span x-show="copied" x-cloak>Copied</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="app-panel p-6">
                <p class="app-kicker text-pink-600 dark:text-pink-200">Guidance</p>
                <div class="mt-4 grid gap-3 md:grid-cols-3 xl:grid-cols-1">
                    <article class="app-panel-muted p-4">
                        <p class="app-heading text-base">Cancellation</p>
                        <p class="app-copy-muted mt-2 text-sm leading-6">Client name plus flight number or service name are enough. Reason is optional but useful.</p>
                    </article>
                    <article class="app-panel-muted p-4">
                        <p class="app-heading text-base">Reschedule</p>
                        <p class="app-copy-muted mt-2 text-sm leading-6">Include the new date and time so the output can clearly state the updated schedule.</p>
                    </article>
                    <article class="app-panel-muted p-4">
                        <p class="app-heading text-base">Delay</p>
                        <p class="app-copy-muted mt-2 text-sm leading-6">Provide either the approximate delay duration or the updated date and time.</p>
                    </article>
                </div>
            </section>
        </div>
    </div>
</section>
