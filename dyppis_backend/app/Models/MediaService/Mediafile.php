<?php

namespace App\Models\MediaService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mediafile extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'file_name',
        'file_type',
        'file_size',
        'category_id',
    ];

    /**
     *  Mediafile category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MediafileCategory::class, 'category_id');
    }
}
