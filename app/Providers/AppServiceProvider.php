<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

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
        // Load global helpers manually (guaranteed fix)
        $helpers = app_path('helpers.php');

        if (File::exists($helpers)) {
            require_once $helpers;
        }
    }
    
}
