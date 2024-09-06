<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function(){
        Route::get('/', HomeController::class)->name('home');

        Route::get(LaravelLocalization::transRoute('routes.projects'), ProjectsController::class)->name('projects');
        Route::get(LaravelLocalization::transRoute('routes.project'), ProjectController::class)->name('project');

        Route::get(LaravelLocalization::transRoute('routes.articles'), ArticlesController::class)->name('articles');
        Route::get(LaravelLocalization::transRoute('routes.article'), ArticleController::class)->name('article');
    }
);
