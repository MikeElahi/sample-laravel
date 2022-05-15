<?php

namespace WiGeeky\Todo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'label' => ['string', 'max:255'],
        ];
    }
}