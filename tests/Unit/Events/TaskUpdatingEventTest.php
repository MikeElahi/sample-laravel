<?php

namespace WiGeeky\Todo\Tests\Unit\Events;

use Illuminate\Support\Facades\Event;
use WiGeeky\Todo\Events\TaskUpdating;
use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Feature\FeatureTestCase;

class TaskUpdatingEventTest extends FeatureTestCase // todo remove
{
    /** @test */
    public function it_gets_dispatched_on_task_update()
    {
        Event::fake();
        $user = $this->createUser();
        /** @var Task $task */
        $task = $user->tasks()->create(
            factory(Task::class)->make()->toArray()
        );
        $task->update(['title' => 'Something']);
        Event::assertDispatched(TaskUpdating::class);
    }
}