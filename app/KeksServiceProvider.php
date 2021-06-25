<?php

namespace MasterDmx\LaravelKeks;

use Illuminate\Support\ServiceProvider;

class KeksServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/keks.php', 'keks');

        $this->app->singleton(Integrator::class, function () {
            return new Integrator(
                config('keks.project_id'),
                config('keks.api_token'),
                config('keks.base_url'),
            );
        });

        $this->app->singleton(Keks::class);
    }
}
