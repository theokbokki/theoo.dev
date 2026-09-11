<?php

use App\Http\Controllers\Auth\LoginShowController;
use App\Http\Controllers\Auth\LoginStoreController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Links\LinksCreateController;
use App\Http\Controllers\Links\LinksDeleteController;
use App\Http\Controllers\Links\LinksDraftController;
use App\Http\Controllers\Links\LinksEditController;
use App\Http\Controllers\Links\LinksIndexController;
use App\Http\Controllers\Links\LinksUpdateController;
use App\Http\Controllers\Notes\NotesCreateController;
use App\Http\Controllers\Notes\NotesDeleteController;
use App\Http\Controllers\Notes\NotesDraftController;
use App\Http\Controllers\Notes\NotesEditController;
use App\Http\Controllers\Notes\NotesImageController;
use App\Http\Controllers\Notes\NotesIndexController;
use App\Http\Controllers\Notes\NotesShowController;
use App\Http\Controllers\Notes\NotesStatusController;
use App\Http\Controllers\Notes\NotesUpdateController;
use App\Http\Controllers\Posts\AttachmentsUploadController;
use App\Http\Controllers\Posts\PostsCreateController;
use App\Http\Controllers\Posts\PostsDeleteController;
use App\Http\Controllers\Posts\PostsDraftController;
use App\Http\Controllers\Posts\PostsEditController;
use App\Http\Controllers\Posts\PostsIndexController;
use App\Http\Controllers\Posts\PostsUpdateController;
use App\Http\Controllers\RssFeedController;
use Illuminate\Support\Facades\Route;

/* AUTH */

Route::get('/login', LoginShowController::class)->name('login')->middleware('guest');

Route::post('/login', LoginStoreController::class)->name('login.store')->middleware('guest');

Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth');

/* RSS */
Route::get('/rss', RssFeedController::class)->name('rss');

/* HOME */

Route::get('/', HomeController::class)->name('home');

/* NOTES */

Route::get('/notes', NotesIndexController::class)->name('notes.index');

Route::get('/notes/draft', NotesDraftController::class)->name('notes.draft')->middleware('auth');

Route::post('/notes/create', NotesCreateController::class)->name('notes.create')->middleware('auth');

Route::get('/notes/{note}', NotesShowController::class)->name('notes.show');

Route::get('/notes/edit/{note}', NotesEditController::class)->name('notes.edit')->middleware('auth');

Route::post('/notes/update/{note}', NotesUpdateController::class)->name('notes.update')->middleware('auth');

Route::post('/notes/delete/{note}', NotesDeleteController::class)->name('notes.delete')->middleware('auth');

Route::post('/notes/image', NotesImageController::class)->name('notes.image')->middleware('auth');

Route::post('/notes/status/{note}', NotesStatusController::class)->name('notes.status')->middleware('auth');

/* LINKS */

Route::get('/links', LinksIndexController::class)->name('links.index');

Route::get('/links/draft', LinksDraftController::class)->name('links.draft')->middleware('auth');

Route::post('/links/create', LinksCreateController::class)->name('links.create')->middleware('auth');

Route::get('/links/edit/{link}', LinksEditController::class)->name('links.edit')->middleware('auth');

Route::post('/links/update/{link}', LinksUpdateController::class)->name('links.update')->middleware('auth');

Route::post('/links/delete/{link}', LinksDeleteController::class)->name('links.delete')->middleware('auth');

/* POSTS */

Route::get('/feed', PostsIndexController::class)->name('posts.index');

Route::get('/feed/draft', PostsDraftController::class)->name('posts.draft')->middleware('auth');

Route::post('/feed/create', PostsCreateController::class)->name('posts.create')->middleware('auth');

Route::post('/feed/attachments/upload', AttachmentsUploadController::class)
    ->name('posts.attachments.upload')
    ->middleware('auth');

Route::get('/feed/edit/{post}', PostsEditController::class)->name('posts.edit')->middleware('auth');

Route::post('/feed/update/{post}', PostsUpdateController::class)->name('posts.update')->middleware('auth');

Route::post('/feed/delete/{post}', PostsDeleteController::class)->name('posts.delete')->middleware('auth');
