<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AdRepositoryInterface;
use App\Repositories\AdRepository;
use App\Interfaces\SpaceRepositoryInterface;
use App\Repositories\SpaceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdRepositoryInterface::class, AdRepository::class);
        $this->app->bind(SpaceRepositoryInterface::class, SpaceRepository::class);
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
