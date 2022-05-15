<?php

use Illuminate\Support\Facades\Route;
use WiGeeky\Todo\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);