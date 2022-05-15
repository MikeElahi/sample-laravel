<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use WiGeeky\Todo\Http\Requests\LabelTaskStoreRequest;
use WiGeeky\Todo\Models\Task;

class LabelTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(int $task, LabelTaskStoreRequest $request)
    {
        Task::query()->findOrFail($task)->labels()->sync($request->input());

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
