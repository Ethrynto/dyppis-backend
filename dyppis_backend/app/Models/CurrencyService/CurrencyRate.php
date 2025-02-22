<?php

namespace App\Models\CurrencyService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'from_id',
        'to_id',
        'value',
    ];

    protected $casts = [
        'value' => 'float',
    ];

    /**
     *  Currency as "from".
     */
    public function fromCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'from_id');
    }

    /**
     *  Currency as "from".
     */
    public function toCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'to_id');
    }
}
