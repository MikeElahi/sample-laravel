<?php

namespace WiGeeky\Todo\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use WiGeeky\Todo\TodoServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [TodoServiceProvider::class];
    }
}