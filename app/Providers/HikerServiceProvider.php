<?php

namespace App\Providers;

use Hiker\Hiker;
use Hiker\HikerApplicationServiceProvider;
use \Hiker\Components\Auth;
use Illuminate\Support\Facades\Vite;

class HikerServiceProvider extends HikerApplicationServiceProvider
{
    /**
     * Register loadable route paths
     */
    public function register(): void
    {
        parent::register();

        $this->loadCliForRoutes([
            'POST' => [],
        ]);

        if (app()->environment('local')) {
            Vite::useHotFile(public_path('vendor/hiker/hot'));
        }
    }

    /**
     * Register Component Constructors
     */
    public function constructors(): void
    {
        Hiker::chrome('auth.login', Auth\Login\LoginConstructor::class);
        Hiker::chrome('auth.password.email', Auth\Password\Email\EmailConstructor::class);
        Hiker::chrome('auth.password.email-sent', Auth\Password\EmailSent\EmailSentConstructor::class);
        Hiker::chrome('auth.password.reset', Auth\Password\Reset\ResetConstructor::class);
        Hiker::chrome('account', \App\Hiker\Chrome\Account::class);
        Hiker::chrome('sidebar', \App\Hiker\Chrome\Sidebar::class);
        Hiker::chrome('navigation', \App\Hiker\Chrome\Navigation::class);
        Hiker::chrome('dashboard', \App\Hiker\Chrome\Dashboard::class);
        Hiker::chrome('editor', \App\Hiker\Chrome\Editor::class);
        Hiker::chrome('search', \App\Hiker\Chrome\Search::class);
    }

    /**
     * Register extra user profiles ("roles" or "groups")
     */
    public function profiles(): void
    {
    }

    /**
     * Apply extra configurations only when the UI is rendering
     */
    public function rendering(): void
    {
    }

    /**
     * Apply UI customizations (logo, theme, favicons,…)
     */
    public function customize(): void
    {
    }
}