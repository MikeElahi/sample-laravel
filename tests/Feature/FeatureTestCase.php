<?php

namespace WiGeeky\Todo\Tests\Feature;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use WiGeeky\Todo\Tests\Fixture\UserFixture;
use WiGeeky\Todo\Tests\TestCase;

class FeatureTestCase extends TestCase
{
    use WithFaker;

    /**
     * @param array $parameters
     * @return UserFixture
     */
    public function createUser(array $parameters = []): UserFixture
    {
        $user = new UserFixture(array_merge([
           'name' => $this->faker->name,
           'email' => $this->faker->unique()->safeEmail,
           'email_verified_at' => now(),
           'password' => Hash::make('password'),
           'token' => Str::random(),
        ], $parameters));
        $user->save();
        return $user;
    }
}