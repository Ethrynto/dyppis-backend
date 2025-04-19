<?php

namespace App\Http\Resources\ProductService;

use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
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
            'title' => TranslationResource::make($this->title),
            'attribute' => AttributeResource::make($this->attribute) ?? null,
            'value_int' => $this->value_int,
            'value' => $this->value,
        ];
    }
}
