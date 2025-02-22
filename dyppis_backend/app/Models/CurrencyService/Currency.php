<?php

namespace App\Models\CurrencyService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'code',
        'symbol',
    ];

    /**
     *  Exchange rates where this currency acts as "from".
     */
    public function fromRates(): HasMany
    {
        return $this->hasMany(CurrencyRate::class, 'from_id');
    }

    /**
     *  Exchange rates where this currency acts as "to".
     */
    public function toRates(): HasMany
    {
        return $this->hasMany(CurrencyRate::class, 'to_id');
    }
}
