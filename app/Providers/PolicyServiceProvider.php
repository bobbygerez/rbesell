<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Policy\PolicyController;
use App\Repo\Policy\PolicyInterface;
use App\Repo\Policy\PolicyRepository;

class PolicyServiceProvider extends ServiceProvider
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
        $this->app->when(PolicyController::class)
         ->needs(PolicyInterface::class)
         ->give(PolicyRepository::class);

       
    }
}
