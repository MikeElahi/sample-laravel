<?php

namespace WiGeeky\Todo\Concerns;

use Illuminate\Database\Eloquent\Relations\HasMany;
use WiGeeky\Todo\Models\Task;

trait HasTodo
{
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
}
