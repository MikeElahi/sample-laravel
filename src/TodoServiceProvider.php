<?php

namespace WiGeeky\Todo;

use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->loadFactoriesFrom(__DIR__ . "/../database/factories");
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