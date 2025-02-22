<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Translation extends Model
{
    use Searchable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'ar', 'de', 'en', 'es', 'fr', 'it', 'ru', 'tr'];

    /**
     *  Transformation to array for indexing
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
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

