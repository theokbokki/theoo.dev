<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::macro('humanDate', function () {
            $now = Carbon::now();
            $minutes = (int) $this->diffInMinutes($now, true);

            if ($minutes < 60) {
                return "{$minutes}min ago";
            }

            if ($this->isToday()) {
                return (int) $this->diffInHours($now, true) . 'h ago';
            }

            if ($this->isYesterday()) {
                return 'Yesterday';
            }

            return $this->format('l j F');
        });
    }
}
