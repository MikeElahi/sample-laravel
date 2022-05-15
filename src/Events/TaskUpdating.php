<?php

namespace WiGeeky\Todo\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use WiGeeky\Todo\Models\Task;

class TaskUpdating
{
    use Dispatchable, SerializesModels;

    /** @var Task */
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

}