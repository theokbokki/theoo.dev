<?php

namespace Modules\Stub\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class StubServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'stub');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Route::middleware('web')->group(__DIR__ . '/../../routes/stub-routes.php');
    }
}
