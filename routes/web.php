<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notes\NotesIndexController;
use App\Http\Controllers\Notes\NotesShowController;

/* HOME */

Route::get('/', HomeController::class)->name('home');

/* NOTES */

Route::get('/notes', NotesIndexController::class)->name('notes.index');

Route::get('/notes/{slug}', NotesShowController::class)->name('notes.show');
