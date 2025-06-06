<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ShadersController;
use App\Http\Controllers\SnippetsController;
use App\Http\Controllers\TrinketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/shaders', ShadersController::class)->name('shaders');

Route::get('/links', LinksController::class)->name('links');

Route::get('/notes', NotesController::class)->name('notes');

Route::get('/notes/{slug}', NoteController::class)->name('note');

Route::get('/snippets', SnippetsController::class)->name('snippets');

Route::get('/snippets/{slug}', NoteController::class)->name('snippet');

Route::get('/trinkets', TrinketsController::class)->name('trinkets');
