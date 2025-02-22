<?php

namespace App\Http\Resources\MediaService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediafileCategoryResource extends JsonResource
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
            'path' => $this->path,
            'url' => $this->url,
        ];
    }
}
