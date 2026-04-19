<div x-data="appTheme()" x-init="init()" class="app-theme-switcher" aria-label="Theme switcher">
    <button
        type="button"
        @click="setMode('light')"
        :data-active="resolvedTheme === 'light'"
        :aria-pressed="resolvedTheme === 'light'"
        title="Use light mode"
    >
        <i data-lucide="sun" class="h-4 w-4"></i>
        <span>Light</span>
    </button>
    <button
        type="button"
        @click="setMode('dark')"
        :data-active="resolvedTheme === 'dark'"
        :aria-pressed="resolvedTheme === 'dark'"
        title="Use dark mode"
    >
        <i data-lucide="moon" class="h-4 w-4"></i>
        <span>Dark</span>
    </button>
</div>
