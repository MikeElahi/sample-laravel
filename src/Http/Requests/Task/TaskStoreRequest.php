<?php

namespace WiGeeky\Todo\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => ['string', 'nullable', 'required_if:description,null', 'max:255'],
            'description' => ['string', 'nullable', 'required_if:title,null'],
            'labels'      => ['array', 'nullable'],
            'labels.*'    => ['int', 'exists:labels,id', 'max:255'],
        ];
    }
}
