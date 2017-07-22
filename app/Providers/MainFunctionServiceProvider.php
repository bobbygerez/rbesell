<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\MainFunction\MainFunctionController;
use App\Repo\MainFunction\MainFunctionInterface;
use App\Repo\MainFunction\MainFunctionRepository;

class MainFunctionServiceProvider extends ServiceProvider
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
           $this->app->when(MainFunctionController::class)
             ->needs(MainFunctionInterface::class)
             ->give(MainFunctionRepository::class);
             
    }
}
