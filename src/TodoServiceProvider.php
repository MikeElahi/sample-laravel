<?php

namespace WiGeeky\Todo;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WiGeeky\Todo\Providers\EventServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/todo.php', 'todo');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
        $this->registerRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }

    protected function registerRoutes()
    {
        Route::group(['middleware' => config('todo.middleware'), 'prefix' => config('todo.prefix')], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }
}
