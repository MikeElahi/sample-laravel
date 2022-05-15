<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use WiGeeky\Todo\Http\Resources\TaskResource;
use WiGeeky\Todo\Models\Task;

class TaskController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return TaskResource::collection(
            Task::query()
                ->where('user_id', $request->user()->id)
                ->with('labels')
                ->paginate()
        );
    }
}