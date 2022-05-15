<?php

namespace WiGeeky\Todo\Tests\Unit\Http\Middleware;

use WiGeeky\Todo\Http\Middleware\Authenticate;
use WiGeeky\Todo\Http\Middleware\Authorize;
use WiGeeky\Todo\Tests\TestCase;

class MiddlewareTestCase extends TestCase
{
    protected function defineRoutes($router)
    {
        $router->get('/api/noauth', function () {
            return 'OK';
        });

        $router->get('/api/authenticate', function () {
            return 'OK';
        })->middleware(Authenticate::class);

        $router->get('/api/authorize/{task}', function (int $task) {
            return 'OK';
        })->middleware(Authorize::class);
    }
}
