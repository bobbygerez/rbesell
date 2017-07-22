<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Quantity\AreaManagerQuantityController;
use App\Http\Controllers\Product\AdminProductController;
use App\Http\Controllers\Product\ApiProductController;
use App\Http\Controllers\Product\SystemAdminProductController;
use App\Http\Controllers\Price\AreaManagerPriceController;
use App\Repo\Product\ProductInterface;
use App\Repo\Product\ProductRepository;
use App\Repo\Product\SystemAdminProductRepository;

class ProductServiceProvider extends ServiceProvider
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
        

          $this->app->when(SystemAdminProductController::class)
          ->needs(ProductInterface::class)
          ->give(SystemAdminProductRepository::class);

          $this->app->when(ApiProductController::class)
          ->needs(ProductInterface::class)
          ->give(ProductRepository::class);

         

          $this->app->when(AreaManagerPriceController::class)
          ->needs(ProductInterface::class)
          ->give(AreaManagerProductRepository::class);

           $this->app->when(AreaManagerQuantityController::class)
          ->needs(ProductInterface::class)
          ->give(AreaManagerProductRepository::class);
    }
}
