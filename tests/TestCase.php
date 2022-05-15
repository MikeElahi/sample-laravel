<?php

namespace WiGeeky\Todo\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as Orchestra;
use WiGeeky\Todo\Tests\Fixture\UserFixture;
use WiGeeky\Todo\Tests\Support\WithUser;
use WiGeeky\Todo\Todo;
use WiGeeky\Todo\TodoServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;
    use WithFaker;
    use WithUser;

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

    protected function setUpTraits()
    {
        parent::setUpTraits();
        $uses = \array_flip(\class_uses_recursive(static::class));

        if(isset($uses[WithUser::class])) {
            $this->setUpWithUser();
        }
    }
}