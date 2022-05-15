<?php

namespace WiGeeky\Todo\Models;

use Illuminate\Database\Eloquent\Model;

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
}