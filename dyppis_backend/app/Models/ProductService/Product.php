<?php

namespace App\Models\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\UserService\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'slug',
        'title',
        'description',
    ];

    protected $casts = [
        'id' => 'string',
        'slug' => 'string',
        'title' => 'string',
    ];

    /**
     *  Product platform.
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    /**
     *  Product category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     *  Product delivery.
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    /**
     *  Product attributes.
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'product_id');
    }

    /**
     *  Product attribute values.
     */
    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     *  Product users.
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'products_users', 'product_id', 'user_id');
    }
}

