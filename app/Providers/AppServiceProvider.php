<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Lier la classe Files au conteneur
        // dd('Binding loaded');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}