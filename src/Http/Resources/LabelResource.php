<?php

namespace WiGeeky\Todo\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'label' => $this->resource->label,
            'count' => $this->resource->tasks->count(),
        ];
    }
}