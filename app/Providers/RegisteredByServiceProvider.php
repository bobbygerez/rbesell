<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RegisteredByServiceProvider extends ServiceProvider
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
        
        $this->app->bind('App\Repo\RegisteredBy\RegisteredByInterface', 'App\Repo\RegisteredBy\RegisteredByRepository');
    }
}
