<?php

namespace WiGeeky\Todo\Tests\Unit\Notifications;

use Illuminate\Support\Facades\Notification;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Notifications\TaskWasClosedNotification;
use WiGeeky\Todo\Tests\TestCase;

class TaskWasClosedNotificationTest extends TestCase
{
    /**
     * As a logged-in user, I want to receive a notification when I close the task's status.
     *
     * @test
     */
    public function it_can_notify_a_user_when_their_task_is_closed()
    {
        Notification::fake();
        
        /** @var Task $task */
        $task = $this->user->tasks()->create(
            factory(Task::class)->make()->toArray()
        );

        $task->update(['status' => Task::STATUS_CLOSE]);
        Notification::assertSentTo($this->user, TaskWasClosedNotification::class);
    }
}