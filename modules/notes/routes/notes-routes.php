<?php

use Illuminate\Support\Facades\Route;
use Modules\Notes\Http\Controllers\NotesIndexController;

Route::get('notes', NotesIndexController::class)->name('notes.index');

Route::get('notes/{slug}', function () {})->name('notes.single');

Route::post('notes/create', function () {})->name('notes.create');
