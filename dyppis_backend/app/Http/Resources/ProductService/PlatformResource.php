<?php

namespace App\Http\Resources\ProductService;

use App\Http\Resources\MediaService\MediafileResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlatformResource extends JsonResource
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
            'title' => ($this->title),
            'logo' => MediafileResource::make($this->logo) ?? null,
            'category' => PlatformCategoryResource::make($this->category),
            'parent' => PlatformResource::make($this->parent) ?? null,
            'sales' => $this->sales,
            'views' => $this->views,
        ];
    }
}
