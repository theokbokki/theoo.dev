<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/{page?}', PageController::class)
    ->where('page', '.*')
    ->name('page');
