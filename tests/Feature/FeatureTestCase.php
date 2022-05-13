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
     * @return Builder|Model
     */
    public function createUser(array $parameters = [])
    {
        return UserFixture::query()->create(array_merge([
           'name' => $this->faker->name,
           'email' => $this->faker->unique()->safeEmail,
           'email_verified_at' => now(),
           'password' => Hash::make('password'),
           'token' => Str::random(),
        ], $parameters));
    }
}