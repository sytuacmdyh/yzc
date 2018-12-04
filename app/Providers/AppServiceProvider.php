<?php

namespace App\Providers;

use App\Console\Commands\RouteListSimple;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
        Schema::defaultStringLength(191);
        Horizon::auth(function ($request) {
             return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
