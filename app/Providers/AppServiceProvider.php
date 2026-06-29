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
        // ── PAKSA SKEMA HTTPS SECARA MUTLAK (DIJAMIN BEBAS DARI PERINGATAN BROWSER) ──
        URL::forceScheme('https');
    }
}
