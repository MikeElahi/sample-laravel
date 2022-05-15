<?php

use Illuminate\Support\Facades\Route;
use WiGeeky\Todo\Http\Controllers\LabelController;
use WiGeeky\Todo\Http\Controllers\LabelTaskController;
use WiGeeky\Todo\Http\Controllers\TaskController;

Route::get('tasks', [TaskController::class, 'index']);
Route::get('tasks/{task}', [TaskController::class, 'show']);
Route::post('tasks', [TaskController::class, 'store']);
Route::put('tasks/{task}', [TaskController::class, 'update']);
Route::patch('tasks/{task}', [TaskController::class, 'updateStatus']);
Route::post('tasks/{task}/labels', LabelTaskController::class);

Route::apiResource('labels', LabelController::class)->only(['index', 'store']);