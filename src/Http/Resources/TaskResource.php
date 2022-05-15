<?php

namespace WiGeeky\Todo\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->resource->id,
            'title'       => $this->resource->title,
            'description' => $this->resource->description,
            'labels'      => LabelResource::collection($this->whenLoaded('labels')),
        ];
    }
}
