<?php

namespace App\Providers;

use function config;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use AlibabaCloud\Client\AlibabaCloud;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AlibabaCloud::accessKeyClient(config('app.ali_key'), config('app.ali_secret'))
            ->regionId('cn-hangzhou')
            ->asGlobalClient();

//        \URL::forceScheme('https');
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
