<?php

namespace Modules\Notes\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NotesServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'notes');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Route::middleware('web')->group(__DIR__ . '/../../routes/notes-routes.php');
    }
}
