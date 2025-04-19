<?php

namespace App\Http\Resources\ProductService;

use App\Http\Resources\MediaService\MediafileResource;
use App\Http\Resources\TranslationResource;
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
            'title' => TranslationResource::make($this->title),
            'logo' => MediafileResource::make($this->logo) ?? null,
            'platform' => PlatformResource::make($this->platform) ?? null,
            'category' => CategoryResource::make($this->category) ?? null,
            'delivery' => DeliveryResource::make($this->delivery) ?? null,
            'attributes' => AttributeResource::collection($this->attributes) ?? null,
            'price' => $this->price,
            'old_price' => $this->old_price ?? null,
            'in_stock' => $this->in_stock ?? null,
            'rating' => $this->rating ?? null,
        ];
    }
}
