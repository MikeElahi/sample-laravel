<?php

namespace WiGeeky\Todo\Tests\Unit\Models;

use WiGeeky\Todo\Models\Task;
use WiGeeky\Todo\Tests\Support\WithTask;
use WiGeeky\Todo\Tests\TestCase;

class TaskTest extends TestCase
{
    use WithTask;

    /** @test */
    public function it_can_have_a_null_user_scope()
    {
        $this->createTask(5);
        $this->assertEquals(5, Task::query()->user(null)->count());
    }
}
