<?php

namespace App\Models\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'slug',
        'title_id',
        'logo_id',
        'is_public',
    ];

    protected $casts = [
        'id' => 'string',
        'slug' => 'string',
        'title_id' => 'string',
        'logo_id' => 'string',
        'is_public' => 'boolean',
    ];

    /**
     *  Category title.
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Translation::class, 'title_id', 'id');
    }

    /**
     *  Category logo.
     */
    public function logo(): BelongsTo
    {
        return $this->belongsTo(Mediafile::class, 'logo_id', 'id');
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'categories_platforms', 'category_id', 'platform_id');
    }
}
