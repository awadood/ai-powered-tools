<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'AI Playground' }}</title>
        <meta
            name="description"
            content="A playful Laravel demo gallery for AI-powered tools built with Livewire, Tailwind, Flowbite, Alpine, and Lucide."
        >
        <script>
            (() => {
                const storedThemePreference = window.localStorage.getItem('theme-preference');
                const themePreference = ['light', 'dark', 'system'].includes(storedThemePreference)
                    ? storedThemePreference
                    : 'system';
                const resolvedTheme = themePreference === 'system'
                    ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
                    : themePreference;

                document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
                document.documentElement.dataset.theme = resolvedTheme;
                document.documentElement.dataset.themePreference = themePreference;
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen antialiased transition-colors duration-300">
        <div class="app-background fixed inset-0 -z-20"></div>
        <div class="app-grid fixed inset-0 -z-10 bg-[size:5rem_5rem] [mask-image:radial-gradient(circle_at_center,black,transparent_85%)]"></div>

        @yield('content')

        @livewireScriptConfig
    </body>
</html>
