<?php

namespace App\Models\MediaService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediafileCategory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'slug',
        'title',
        'path',
        'url',
    ];

    /**
     *  Category mediafiles.
     */
    public function mediafiles(): HasMany
    {
        return $this->hasMany(Mediafile::class, 'category_id');
    }
}
