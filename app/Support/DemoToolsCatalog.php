<?php

namespace App\Support;

use Illuminate\Support\Collection;

class DemoToolsCatalog
{
    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function all(): Collection
    {
        /** @var array<int, array<string, mixed>> $items */
        $items = config('demo-tools.items', []);

        return collect($items)->values();
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findBySlug(string $slug): ?array
    {
        /** @var array<string, mixed>|null $tool */
        $tool = $this->all()->firstWhere('slug', $slug);

        return $tool;
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function relatedTo(string $slug, int $limit = 4): Collection
    {
        return $this->all()
            ->reject(fn (array $tool) => $tool['slug'] === $slug)
            ->take($limit)
            ->values();
    }
}
