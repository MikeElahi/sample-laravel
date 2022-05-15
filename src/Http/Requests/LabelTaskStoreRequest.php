<?php

namespace WiGeeky\Todo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelTaskStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            '*' => ['int', 'exists:labels,id'],
        ];
    }
}
