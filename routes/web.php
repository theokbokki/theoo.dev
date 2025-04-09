<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShadersController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/shaders', ShadersController::class)->name('shaders');

Route::get('/links', LinksController::class)->name('links');

Route::get('/notes', NotesController::class)->name('notes');

Route::get('/notes/{note:slug}', NoteController::class)->name('note.single');
