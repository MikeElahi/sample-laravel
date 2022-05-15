<?php

namespace WiGeeky\Todo\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => ['string', 'nullable', 'required_if:description,null', 'max:255'],
            'description' => ['string', 'nullable', 'required_if:title,null'],
        ];
    }
}
