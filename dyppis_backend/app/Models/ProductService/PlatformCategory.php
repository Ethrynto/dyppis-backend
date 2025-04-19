<?php

namespace App\Models\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlatformCategory extends Model
{

    protected $table = 'platform_categories';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'logo',
        'created_at',
        'updated_at'
    ];

    /**
     *  Platform category title.
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Translation::class, 'title_id', 'id');
    }

    /**
     *  Platform category logo.
     */
    public function logo(): BelongsTo
    {
        return $this->belongsTo(Mediafile::class, 'logo_id', 'id');
    }
}
