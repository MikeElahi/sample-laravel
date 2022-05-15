<?php

namespace WiGeeky\Todo\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Listeners\SendNotificationOnTaskClose;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskUpdating::class => [
            SendNotificationOnTaskClose::class,
        ]
    ];

}