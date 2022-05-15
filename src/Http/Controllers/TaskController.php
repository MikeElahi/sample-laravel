<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use WiGeeky\Todo\Models\Task;

class TaskController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Task::query()->paginate();
    }
}