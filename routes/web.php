<?php

use App\Http\Controllers\CreatePageController;
use App\Http\Controllers\EditPageController;
use App\Http\Controllers\ShowLoginController;
use App\Http\Controllers\ShowPageController;
use App\Http\Controllers\StoreLoginController;
use App\Http\Controllers\StorePageController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/login', ShowLoginController::class)
    ->middleware('guest')
    ->name('login');

Route::post('/login', StoreLoginController::class)
    ->middleware('guest')
    ->name('login.store');

// Page
Route::get('/page/create/{parentId}', CreatePageController::class)
    ->middleware('auth')
    ->name('page.create');

Route::post('/page/edit/{page?}', EditPageController::class)
    ->middleware('auth')
    ->name('page.edit');

Route::post('/page/store', StorePageController::class)
    ->middleware('auth')
    ->name('page.store');

Route::get('/{page?}', ShowPageController::class)
    ->where('page', '.*')
    ->name('page.show');
