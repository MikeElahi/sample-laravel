<?php
return [
    'prefix' => 'api',
    'middleware' => [
        \WiGeeky\Todo\Http\Middleware\Authenticate::class,
        \WiGeeky\Todo\Http\Middleware\Authorize::class,
    ]
];