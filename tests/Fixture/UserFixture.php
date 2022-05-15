<?php

namespace WiGeeky\Todo\Tests\Fixture;

use Illuminate\Foundation\Auth\User;
use WiGeeky\Todo\Concerns\HasTodo;

class UserFixture extends User
{
    use HasTodo;

    protected $table = "users";

    protected $guarded = ['id'];
}