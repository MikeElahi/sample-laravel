<?php

namespace WiGeeky\Todo\Tests\Unit\Notifications;

use Illuminate\Support\Facades\Notification;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Notifications\TaskWasClosedNotification;
use WiGeeky\Todo\Tests\Support\WithTask;
use WiGeeky\Todo\Tests\TestCase;

class TaskWasClosedNotificationTest extends TestCase
{
    use WithTask;

    /**
     * As a logged-in user, I want to receive a notification when I close the task's status.
     *
     * @test
     */
    public function it_can_notify_a_user_when_their_task_is_closed()
    {
        Notification::fake();

        /** @var Task $task */
        $task = $this->createTask();

        $task->update(['status' => Task::STATUS_CLOSE]);
        Notification::assertSentTo($this->user, TaskWasClosedNotification::class);
    }

    /** @test */
    public function it_can_convert_a_given_message_to_mail()
    {
        $task = $this->createTask();
        $mail = (new TaskWasClosedNotification($task))->toMail();
        $this->assertStringContainsString($task->title, $mail->render());
        $this->assertStringContainsString($task->id, $mail->actionUrl);
    }
}
