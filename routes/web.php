<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShadersController;
use App\Http\Controllers\LinksController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/shaders', ShadersController::class)->name('shaders');

Route::get('/links', LinksController::class)->name('links');
