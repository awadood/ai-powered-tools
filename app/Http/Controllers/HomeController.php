<?php

namespace App\Http\Controllers;

use App\Support\DemoToolsCatalog;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(DemoToolsCatalog $catalog): View
    {
        return view('home', [
            'tools' => $catalog->all()->all(),
        ]);
    }
}
