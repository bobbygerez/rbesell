<?php

namespace App\Providers;

use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\User\SystemAdminUserController;
use Illuminate\Support\ServiceProvider;
use App\Repo\Position\PositionInterface;
use App\Repo\Position\PositionRepository;

class PositionServiceProvider extends ServiceProvider
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
        $this->app->when(PositionController::class)
             ->needs(PositionInterface::class)
             ->give(PositionRepository::class);

         $this->app->when(SystemAdminUserController::class)
         ->needs(PositionInterface::class)
         ->give(PositionRepository::class);

    }
}
