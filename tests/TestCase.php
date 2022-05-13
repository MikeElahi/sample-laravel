<?php

namespace WiGeeky\Todo\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use WiGeeky\Todo\Tests\Fixture\UserFixture;
use WiGeeky\Todo\Todo;
use WiGeeky\Todo\TodoServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Todo::useAuthModel(UserFixture::class);
    }

    protected function getPackageProviders($app): array
    {
        return [TodoServiceProvider::class];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
    }
}