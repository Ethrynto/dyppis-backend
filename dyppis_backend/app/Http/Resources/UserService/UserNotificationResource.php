<?php

namespace App\Http\Resources\UserService;

use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->user),
            'title' => TranslationResource::make($this->title),
            'message' => TranslationResource::make($this->message),
            'read_at' => $this->read_at
        ];
    }
}
