<?php

namespace App\Providers;

use App\Services\Utility\LarabarLogger;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
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
        //
        $this->app->singleton('App\Services\Utility\ILogger', function ($app) {
            return new LarabarLogger();
        });
    }

    public function provides()
    {
        return ['App/Service/Utility/ILogger'];
    }
}
