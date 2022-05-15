<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
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
                ->with('labels')
                ->user($request->user()->id)
                ->label($request->input('label'))
                ->paginate()
        );
    }

    public function store(Request $request): TaskResource
    {
        $task = Task::query()
            ->create(array_merge(
                $request->only(['title', 'description']),
                ['user_id' => $request->user()->id]
            ));

        $task->labels()->attach($request->input('labels'));

        return TaskResource::make(
            $task->load('labels'),
        );
    }

    public function update(int $task, Request $request)
    {
        Task::query()
            ->where('id', $task)
            ->update($request->only(['title', 'description']));
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateStatus(int $task, Request $request)
    {
        Task::query()
            ->where('id', $task)
            ->update(['status' => $request->input('status')]);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}