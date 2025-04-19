<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ar' => $this->ar ?? null,
            'de' => $this->de ?? null,
            'en' => $this->en ?? null,
            'es' => $this->es ?? null,
            'fr' => $this->fr ?? null,
            'it' => $this->it ?? null,
            'ru' => $this->ru ?? null,
            'tr' => $this->tr ?? null,
        ];
    }
}
