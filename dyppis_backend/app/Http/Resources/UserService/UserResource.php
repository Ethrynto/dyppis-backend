<?php

namespace App\Http\Resources\UserService;

use App\Http\Resources\MediaService\MediafileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nickname' => $this->nickname,
            'email' => $this->email,
            'avatar' => $this->avatar ? new MediafileResource($this->avatar) : null,
            'rating' => $this->rating
        ];
    }
}
