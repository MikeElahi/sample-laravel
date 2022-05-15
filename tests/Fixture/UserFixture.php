<?php

namespace WiGeeky\Todo\Tests\Fixture;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use WiGeeky\Todo\Concerns\HasTodo;

class UserFixture extends User
{
    use HasTodo;
    use Notifiable;

    protected $table = "users";

    protected $guarded = ['id'];
}