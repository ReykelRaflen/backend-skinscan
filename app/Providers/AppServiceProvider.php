<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ── PENTING: Wajib import Facade URL ini

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
        // ── PAKSA SKEMA HTTPS JIKA DIAKSES MELALUI NGROK ATAU PRODUCTION SERVER ──
        if (str_contains(request()->url(), 'ngrok-free.app') || env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}