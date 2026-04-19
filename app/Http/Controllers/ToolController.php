<?php

namespace App\Http\Controllers;

use App\Support\DemoToolsCatalog;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ToolController extends Controller
{
    public function show(string $tool, DemoToolsCatalog $catalog): View
    {
        $selectedTool = $catalog->findBySlug($tool);

        if ($selectedTool === null) {
            throw new NotFoundHttpException();
        }

        return view($selectedTool['view'] ?? 'tool-placeholder', [
            'tool' => $selectedTool,
            'relatedTools' => $catalog->relatedTo($tool)->all(),
        ]);
    }
}
