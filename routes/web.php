<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notes\NotesIndexController;

/* HOME */

Route::get('/', HomeController::class)->name('home');

/* NOTES */

Route::get('/notes', NotesIndexController::class)->name('notes.index');
