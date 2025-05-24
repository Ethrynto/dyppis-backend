<?php

namespace App\Http\Resources\ProductService;

use App\Http\Resources\MediaService\MediafileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'logo' => MediafileResource::make($this->logo) ?? null,
            'is_public' => $this->is_public,
        ];
    }
}
