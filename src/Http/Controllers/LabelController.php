<?php

namespace WiGeeky\Todo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use WiGeeky\Todo\Http\Requests\LabelStoreRequest;
use WiGeeky\Todo\Http\Resources\LabelResource;
use WiGeeky\Todo\Models\Label;

class LabelController extends BaseController
{
    public function index(): AnonymousResourceCollection
    {
        return LabelResource::collection(Label::query()->paginate());
    }

    public function store(LabelStoreRequest $request): LabelResource
    {
        return LabelResource::make(
            Label::query()->firstOrCreate($request->only(['label']))
        );
    }
}