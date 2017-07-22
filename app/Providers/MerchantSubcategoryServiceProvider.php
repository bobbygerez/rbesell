<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MerchantSubcategoryServiceProvider extends ServiceProvider
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
        
        $this->app->bind("App\Repo\MerchantSubcategory\MerchantSubcategoryInterface", "App\Repo\MerchantSubcategory\MerchantSubcategoryRepository");
    }
}
