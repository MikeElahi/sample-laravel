<?php

namespace WiGeeky\Todo;

use Illuminate\Support\Facades\Gate;
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
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->loadFactoriesFrom(__DIR__ . "/../database/factories");
        $this->registerRoutes();
        $this->registerGates();
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
        // TODO add config support
        Route::group(['middleware' => 'authenticate', 'prefix' => 'api'], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    protected function registerGates()
    {
        Gate::define('view-task', function ($user, $task) {
           return $user->id == $task->user_id;
        });
    }
}