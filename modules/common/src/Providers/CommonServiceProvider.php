<?php

namespace Modules\Common\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'common');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Route::middleware('web')->group(__DIR__ . '/../../routes/common-routes.php');
    }
}
