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

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
        <div class="fixed inset-0 -z-20 bg-[radial-gradient(circle_at_top,_rgba(244,114,182,0.16),_transparent_32%),radial-gradient(circle_at_80%_20%,_rgba(59,130,246,0.18),_transparent_25%),linear-gradient(180deg,_#0f172a_0%,_#020617_100%)]"></div>
        <div class="fixed inset-0 -z-10 bg-[linear-gradient(to_right,rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:5rem_5rem] [mask-image:radial-gradient(circle_at_center,black,transparent_85%)]"></div>

        @yield('content')

        @livewireScriptConfig
    </body>
</html>
