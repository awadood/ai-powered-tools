import 'flowbite';
import { initFlowbite } from 'flowbite';
import { createIcons, icons } from 'lucide';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

const systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');

const resolveTheme = (mode) =>
    mode === 'system' ? (systemThemeQuery.matches ? 'dark' : 'light') : mode;

const applyThemeMode = (mode) => {
    const resolvedTheme = resolveTheme(mode);

    document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
    document.documentElement.dataset.theme = resolvedTheme;
    document.documentElement.dataset.themePreference = mode;
    window.localStorage.setItem('theme-preference', mode);
    window.dispatchEvent(
        new CustomEvent('app-theme-changed', {
            detail: { mode, resolvedTheme },
        }),
    );
};

window.appTheme = () => ({
    mode: document.documentElement.dataset.themePreference || 'system',
    resolvedTheme: document.documentElement.dataset.theme || resolveTheme(document.documentElement.dataset.themePreference || 'system'),
    init() {
        this.sync();

        window.addEventListener('app-theme-changed', (event) => {
            this.mode = event.detail.mode;
            this.resolvedTheme = event.detail.resolvedTheme;
        });
    },
    sync() {
        this.mode = document.documentElement.dataset.themePreference || 'system';
        this.resolvedTheme = document.documentElement.dataset.theme || resolveTheme(this.mode);
    },
    setMode(mode) {
        applyThemeMode(mode);
    },
});

systemThemeQuery.addEventListener('change', () => {
    const mode = document.documentElement.dataset.themePreference || 'system';

    if (mode === 'system') {
        applyThemeMode('system');
    }
});

const bootUi = () => {
    initFlowbite();
    createIcons({
        icons,
        attrs: {
            'stroke-width': 1.75,
        },
    });
};

window.Alpine = Alpine;
window.Livewire = Livewire;

Livewire.start();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootUi, { once: true });
} else {
    bootUi();
}

document.addEventListener('livewire:navigated', bootUi);

let scheduledRefresh = null;

const scheduleUiRefresh = () => {
    if (scheduledRefresh !== null) {
        return;
    }

    scheduledRefresh = requestAnimationFrame(() => {
        scheduledRefresh = null;
        bootUi();
    });
};

if (typeof MutationObserver !== 'undefined') {
    const observer = new MutationObserver(scheduleUiRefresh);
    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
}
