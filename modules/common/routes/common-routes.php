<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('common::home');
})->name('home');

Route::get('/notes', function () {
    return view('common::home');
})->name('notes');

Route::get('/feed', function () {
    return view('common::home');
})->name('feed');
