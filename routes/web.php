<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShowLoginController;
use App\Http\Controllers\StoreLoginController;

Route::get("/login", ShowLoginController::class)
    ->middleware("guest")
    ->name("login.show");
Route::post("/login", StoreLoginController::class)
    ->middleware("guest")
    ->name("login.store");

Route::get("/{page?}", PageController::class)
    ->where("page", ".*")
    ->name("page");
