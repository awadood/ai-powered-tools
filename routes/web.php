<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'tools' => config('demo-tools.items', []),
    ]);
})->name('home');

Route::get('/tools/{tool}', function (string $tool) {
    /** @var Collection<int, array<string, string>> $tools */
    $tools = collect(config('demo-tools.items', []));
    $selectedTool = $tools->firstWhere('slug', $tool);

    abort_if($selectedTool === null, 404);

    return view('tool-placeholder', [
        'tool' => $selectedTool,
        'relatedTools' => $tools
            ->reject(fn (array $item) => $item['slug'] === $tool)
            ->take(4)
            ->values()
            ->all(),
    ]);
})->name('tools.show');
