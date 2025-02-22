<?php

namespace App\Http\Resources\MediaService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediafileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'file_name' => $this->file_name,
            'file_type' => $this->file_type,
            'file_size' => $this->file_size,
            'category' => $this->category ? new MediafileCategoryResource($this->category) : null,
        ];
    }
}
