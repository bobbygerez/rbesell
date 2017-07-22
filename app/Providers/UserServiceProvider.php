<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\User\SystemAdminUserController;
use App\Repo\User\SystemAdminUserRepository;


use App\Http\Controllers\Product\AreaManagerProductController;

use App\Http\Controllers\User\AreaManagerUserController;
use App\Repo\User\AreaManagerUserRepository;


use App\Repo\User\UserInterface;
use App\Repo\Role\RoleInterface;
use App\Repo\Role\RoleRepository;

use App\Repo\User\DashboardRepository;

use App\Repo\User\UserRepository;


class UserServiceProvider extends ServiceProvider
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
        $this->app->when(DashboardController::class)
          ->needs(UserInterface::class)
          ->give(DashboardRepository::class);


        /******* SYSTEM ADMIN ***********/
        $this->app->when(SystemAdminUserController::class)
          ->needs(UserInterface::class)
          ->give(SystemAdminUserRepository::class);

        $this->app->when(SystemAdminUserController::class)
          ->needs(RoleInterface::class)
          ->give(RoleRepository::class);


        /************ AREA MANAGER **********/

        $this->app->when(AreaManagerProductController::class)
          ->needs(UserInterface::class)
          ->give(AreaManagerUserRepository::class);

        $this->app->when(AreaManagerUserController::class)
          ->needs(UserInterface::class)
          ->give(AreaManagerUserRepository::class);


    }
}
