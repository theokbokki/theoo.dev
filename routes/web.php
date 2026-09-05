<?php

use App\Http\Controllers\Notes\NotesCreateController;
use App\Http\Controllers\Notes\NotesDeleteController;
use App\Http\Controllers\Notes\NotesStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notes\NotesIndexController;
use App\Http\Controllers\Notes\NotesShowController;
use App\Http\Controllers\Notes\NotesEditController;
use App\Http\Controllers\Notes\NotesUpdateController;
use App\Http\Controllers\Notes\NotesImageController;
use App\Http\Controllers\Links\LinksIndexController;

/* HOME */

Route::get('/', HomeController::class)->name('home');

/* NOTES */

Route::get('/notes', NotesIndexController::class)->name('notes.index');

Route::get('/notes/{slug}', NotesShowController::class)->name('notes.show');

Route::get('/notes/edit/{slug}', NotesEditController::class)->name('notes.edit');

Route::post('/notes/create', NotesCreateController::class)->name('notes.create');

Route::post('/notes/update/{slug}', NotesUpdateController::class)->name('notes.update');

Route::post('/notes/delete/{slug}', NotesDeleteController::class)->name('notes.delete');

Route::post('/notes/image', NotesImageController::class)->name('notes.image');

Route::post('/notes/status/{slug}', NotesStatusController::class)->name('notes.status');

/* LINKS */

Route::get('/links', LinksIndexController::class)->name('links.index');
