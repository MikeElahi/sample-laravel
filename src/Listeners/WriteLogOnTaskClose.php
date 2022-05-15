<?php

namespace WiGeeky\Todo\Listeners;

use Illuminate\Support\Facades\Log;
use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Models\Task;

class WriteLogOnTaskClose
{
    public function handle(TaskUpdating $event)
    {
        if ($event->task->isDirty('status') and
            $event->task->status == Task::STATUS_CLOSE) {
            Log::info("Task #{$event->task->id} has just been closed.");
        }
    }
}
