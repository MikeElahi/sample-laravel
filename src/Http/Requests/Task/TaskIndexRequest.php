<?php

namespace WiGeeky\Todo\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'label' => ['nullable', 'exists:labels,id'],
        ];
    }
}