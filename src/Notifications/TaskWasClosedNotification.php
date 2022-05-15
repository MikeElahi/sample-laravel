<?php

namespace WiGeeky\Todo\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use WiGeeky\Todo\Models\Task;

class TaskWasClosedNotification extends Notification implements ShouldQueue
{
    /** @var Task */
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->line("'{$this->task->title}' has been closed!")
            ->action('View the Task', url("/tasks/{$this->task->id}"))
            ->line('We will see you with another task soon!');
    }
}
