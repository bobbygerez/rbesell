<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MainCategoryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repo\MainCategory\MainCategoryInterface', 'App\Repo\MainCategory\MainCategoryRepository');
    }
}
