<?php

namespace App\Models\UserService;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotification extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'title_id',
        'message_id',
        'read_at',
    ];

    protected $casts = [
        'read_at'     => 'datetime',
        'created_at'  => 'datetime',
    ];


    /**
     *  Notification user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  Notification title.
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Translation::class, 'title_id');
    }

    /**
     *  Notification message.
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Translation::class, 'message_id');
    }
}
