<?php

namespace App\Models\UserService;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\MediaService\Mediafile;
use Database\Factories\UserService\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'balance' => 'float',
            'rating' => 'float',
        ];
    }

    /**
     *  User avatar
     */
    public function avatar(): BelongsTo
    {
        return $this->belongsTo(Mediafile::class, 'avatar_id');
    }

    /**
     *  User logs.
     */
    public function logs(): HasMany
    {
        return $this->hasMany(UserLog::class, 'user_id');
    }

    /**
     *  User notifications.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }
}
