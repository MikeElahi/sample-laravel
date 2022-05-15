<?php

namespace WiGeeky\Todo\Tests\Unit\Events;

use Illuminate\Support\Facades\Event;
use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\TestCase;

class TaskUpdatingEventTest extends TestCase
{
    /** @test */
    public function it_gets_dispatched_on_task_update()
    {
        Event::fake();
        /** @var Task $task */
        $task = $this->user->tasks()->create(
            factory(Task::class)->make()->toArray()
        );
        $task->update(['title' => 'Something']);
        Event::assertDispatched(TaskUpdating::class);
    }
}
