<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ShowLoginController;
use App\Http\Controllers\StoreLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', ShowLoginController::class)
    ->middleware('guest')
    ->name('login.show');
Route::post('/login', StoreLoginController::class)
    ->middleware('guest')
    ->name('login.store');

Route::get('/{page?}', PageController::class)
    ->where('page', '.*')
    ->name('page');
