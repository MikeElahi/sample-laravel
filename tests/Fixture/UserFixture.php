<?php

namespace WiGeeky\Todo\Tests\Fixture;

use Illuminate\Foundation\Auth\User;

class UserFixture extends User
{
    protected $table = "users";

    protected $guarded = ['id'];
}