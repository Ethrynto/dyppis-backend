<?php

namespace App\Models\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    protected $table = 'platforms';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'slug',
        'title',
        'category_id',
        'parent_id',
        'logo_id',
        'sales',
        'views',
    ];

    protected $casts = [
        'id' => 'string',
        'slug' => 'string',
        'title' => 'string',
        'category_id' => 'string',
        'parent_id' => 'string',
        'logo_id' => 'string',
        'sales' => 'integer',
        'views' => 'integer',
    ];

    /**
     *  Platform logo.
     */
    public function logo(): BelongsTo
    {
        return $this->belongsTo(Mediafile::class, 'logo_id', 'id');
    }

    /**
     *  Platform category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PlatformCategory::class, 'category_id');
    }

    /**
     *  Platform parent.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'parent_id');
    }

    /**
     * Categories associated with the platform (many-to-many).
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_platforms', 'platform_id', 'category_id', 'id', 'id');
    }
}
