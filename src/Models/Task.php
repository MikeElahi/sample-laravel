<?php

namespace WiGeeky\Todo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WiGeeky\Todo\Todo;

/**
 * Task Model
 *
 * @property int id
 * @property string title
 * @property string description
 * @property string status
 * @property int user_id
 */
class Task extends Model
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSE = 'CLOSE';

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Todo::$authModel, 'user_id', 'id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }
}