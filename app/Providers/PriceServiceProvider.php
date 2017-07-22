<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repo\Price\PriceInterface;
use App\Repo\Price\AreaManagerPriceRepository;
use App\Repo\Price\AreaManagerProductRepository;
use App\Http\Controllers\Price\AreaManagerPriceController;

class PriceServiceProvider extends ServiceProvider
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

          $this->app->when(AreaManagerPriceController::class)
          ->needs(PriceInterface::class)
          ->give(AreaManagerPriceRepository::class);
    }
}
