<?php

namespace WiGeeky\Todo\Tests\Unit\Listeners;

use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Listeners\WriteLogOnTaskClose;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;
use Illuminate\Support\Facades\Log;

class WriteLogOnTaskCloseTest extends FeatureTestCase
{
    /** @test */
    public function it_can_send_logs_on_event_dispatch()
    {
        $user = $this->createUser();
        /** @var Task $task */
        $task = $user->tasks()->create(
            factory(Task::class)->make()->toArray()
        );

        Log::shouldReceive('info')->once();
        $task->status = Task::STATUS_CLOSE;

        (new WriteLogOnTaskClose)->handle(
            new TaskUpdating($task)
        );
    }
}