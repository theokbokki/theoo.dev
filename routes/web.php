<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Notes\NotesIndexController;
use App\Http\Controllers\Notes\NotesShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/menu', MenuController::class)->name('menu');

// NOTES
Route::get('/notes', NotesIndexController::class)->name('notes.index');
Route::get('/notes/{note}', NotesShowController::class)->name('notes.show');
