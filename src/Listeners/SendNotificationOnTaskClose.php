<?php

namespace WiGeeky\Todo\Listeners;

use Illuminate\Notifications\Notifiable;
use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Notifications\TaskWasClosedNotification;
use WiGeeky\Todo\Todo;

class SendNotificationOnTaskClose
{
    public function handle(TaskUpdating $event)
    {
        if ($event->task->isDirty('status') and
            $event->task->status == Task::STATUS_CLOSE and
            in_array(Notifiable::class, class_uses(Todo::$authModel)))
        {
            $event->task->user->notify(new TaskWasClosedNotification($event->task));
        }
    }
}