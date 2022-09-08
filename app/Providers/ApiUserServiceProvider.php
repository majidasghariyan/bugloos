<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ApiUsers\UserRepositoryInterface;
use App\Repositories\ApiUsers\UserRepository;

class ApiUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
