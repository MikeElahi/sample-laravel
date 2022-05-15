<?php

namespace WiGeeky\Todo\Tests\Support;

use WiGeeky\Todo\Models\Task;

trait WithTask
{
    public function createTask($times = 1)
    {
        if ($times != 1) {
            $tasks = factory(Task::class)->times($times)->make();

            return $this->user->tasks()->createMany($tasks->toArray());
        } else {
            $tasks = factory(Task::class)->make();

            return $this->user->tasks()->create($tasks->toArray());
        }
    }
}
