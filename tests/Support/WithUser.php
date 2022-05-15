<?php

namespace WiGeeky\Todo\Tests\Support;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use WiGeeky\Todo\Tests\Fixture\UserFixture;

trait WithUser
{
    public $user;

    public function setUpWithUser()
    {
        $this->user = $this->createUser();
    }

    protected function createUser(): UserFixture
    {
        $user = new UserFixture([
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'token'             => Str::random(),
        ]);
        $user->save();

        return $user;
    }
}
