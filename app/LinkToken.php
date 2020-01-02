<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * App\LinkToken
 *
 * @property int $id
 * @property string $type
 * @property string $token
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkToken whereUserId($value)
 * @mixin \Eloquent
 */
class LinkToken extends Model
{
    protected $fillable = [
        'type',
        'token',
        'user_id',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public const TYPE_VERIFICATION = 'verification';
    public const TYPE_FORGOT_PASSWORD = 'forgot_password';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function createToken(): string
    {
        return Str::uuid()->toString();
    }
}
