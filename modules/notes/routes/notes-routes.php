<?php

use Illuminate\Support\Facades\Route;
use Modules\Notes\Http\Controllers\NotesIndexController;

Route::get('notes', NotesIndexController::class)->name('notes.index');
