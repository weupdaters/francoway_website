<?php
 
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
 
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
        Paginator::useBootstrapFive();

        // Load global helpers
        $helpers = app_path('helpers.php');
 
        if (File::exists($helpers)) {
            require_once $helpers;
        }
 
        // Load settings globally for all views if table exists
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'key')->toArray();
            View::share('settings', $settings);
        } else {
            View::share('settings', []);
        }
    }
}