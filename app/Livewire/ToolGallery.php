<?php

namespace App\Livewire;

use Livewire\Component;

class ToolGallery extends Component
{
    public array $tools = [];

    public array $categories = [];

    public function mount(array $tools = []): void
    {
        $this->tools = $tools !== [] ? $tools : config('demo-tools.items', []);

        $this->categories = collect($this->tools)
            ->pluck('category')
            ->unique()
            ->prepend('All')
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.tool-gallery');
    }
}
