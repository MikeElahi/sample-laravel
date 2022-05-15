<?php

namespace WiGeeky\Todo;

class Todo
{
    // This static variable allows for swapping the user model during testing
    public static $authModel = 'App\\Models\\User';

    public static function useAuthModel($authModel): void
    {
        self::$authModel = $authModel;
    }
}
