<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $site_name = "Swift Care Distribution ::: ERP Solution®";
        $site_logo = "logo.png";
        View::share(['site_name' => $site_name, 'site_logo' => $site_logo]);
    }
}
