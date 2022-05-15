<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use WiGeeky\Todo\Http\Resources\LabelResource;
use WiGeeky\Todo\Models\Label;

class LabelController extends BaseController
{
    public function store(Request $request): LabelResource
    {
        return LabelResource::make(
            Label::query()->firstOrCreate($request->only(['label']))
        );
    }
}