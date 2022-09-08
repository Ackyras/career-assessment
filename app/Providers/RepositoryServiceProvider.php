<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Repositories\API\CityRepository;
// use App\Repositories\API\ProvinceRepository;
use App\Repositories\Database\CityRepository;
use App\Repositories\Database\ProvinceRepository;
use App\Repositories\Interfaces\CityInterface;
use App\Repositories\Interfaces\ProvinceInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Database Repository by Default
        $this->app->bind(ProvinceInterface::class, ProvinceRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
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
