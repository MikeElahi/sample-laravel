<?php

namespace WiGeeky\Todo\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use WiGeeky\Todo\Models\Task;

class TaskUpdateStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => ['required', Rule::in([Task::STATUS_CLOSE, Task::STATUS_OPEN])],
        ];
    }
}