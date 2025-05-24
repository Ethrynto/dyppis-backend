<?php

namespace App\Http\Resources\ProductService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'platform' => PlatformResource::make($this->platform) ?? null,
            'category' => CategoryResource::make($this->category) ?? null,
            'value_type' => $this->value_type,
            'values' => $this->values,
        ];
    }
}
