<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BarangayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Barangay\BarangayInterface', 'App\Repo\Barangay\BarangayRepository');
    }
}
