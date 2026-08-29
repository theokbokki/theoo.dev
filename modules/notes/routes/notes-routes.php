<?php

use Illuminate\Support\Facades\Route;
use Modules\Notes\Http\Controllers\NotesIndexController;
use Modules\Notes\Http\Controllers\NotesSingleController;

Route::get('notes', NotesIndexController::class)->name('notes.index');

Route::get('notes/{slug}', NotesSingleController::class)->name('notes.single');

Route::post('notes/create', function () {})->name('notes.create');
