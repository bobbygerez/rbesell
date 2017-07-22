<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Product\BranchManagerProductController;
use App\Http\Controllers\Merchant\SystemAdminMerchantController;

use App\Repo\Merchant\MerchantInterface;
use App\Repo\Merchant\MerchantRepository;
use App\Repo\Merchant\SystemAdminMerchantRepository;

class MerchantServiceProvider extends ServiceProvider
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
        $this->app->when(BranchManagerProductController::class)
          ->needs(MerchantInterface::class)
          ->give(MerchantRepository::class);

        $this->app->when(SystemAdminMerchantController::class)
          ->needs(MerchantInterface::class)
          ->give(SystemAdminMerchantRepository::class);
    }
}
