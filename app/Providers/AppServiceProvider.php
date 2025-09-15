<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Tambahkan baris ini
use Illuminate\Support\Facades\URL;

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
        // Tambahkan blok if ini
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
