<?php

namespace App\Http\Resources\ProductService;

use App\Http\Resources\MediaService\MediafileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
//            'images' => MediafileResource::collection($this->images) ?? null,
            'platform' => PlatformResource::make($this->platform) ?? null,
            'category' => CategoryResource::make($this->category) ?? null,
            'delivery' => DeliveryResource::make($this->delivery) ?? null,
            'attributes' => AttributeResource::collection($this->attributes) ?? null,
            'images' => ($this->images) ?? null,
            'price' => $this->price,
            'old_price' => $this->old_price ?? null,
            'in_stock' => $this->in_stock ?? null,
            'rating' => $this->rating ?? null,
        ];
    }
}
