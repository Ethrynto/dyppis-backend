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
            'ar' => $this->ar,
            'de' => $this->de,
            'en' => $this->en,
            'es' => $this->es,
            'fr' => $this->fr,
            'it' => $this->it,
            'ru' => $this->ru,
            'tr' => $this->tr,
        ];
    }
}
