<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/tools/{tool}', [ToolController::class, 'show'])->name('tools.show');
