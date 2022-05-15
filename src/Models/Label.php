<?php

namespace WiGeeky\Todo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Label Model
 *
 * @property int id
 * @property string title
 */
class Label extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}