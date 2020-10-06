<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * App\UrlToken
 *
 * @property int $id
 * @property string $type
 * @property string $token
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UrlToken whereUserId($value)
 * @mixin \Eloquent
 */
class UrlToken extends Model
{
  public const TYPE_VERIFICATION = 'verification';
  public const TYPE_FORGOT_PASSWORD = 'forgot_password';
  protected $fillable = [
    'type',
    'token',
    'user_id',
    'expires_at',
  ];

  protected $casts = [
    'expires_at' => 'datetime',
  ];

  public static function createToken(): string
  {
    return Str::uuid()->toString();
  }

  public static function verifyUrl(string $token): string
  {
    return url("/verify?token=$token", [], Str::startsWith(config('app.url'), 'https'));
  }

  public static function forgotPasswordUrl(string $token): string
  {
    return url("/reset-password?token=$token", [], Str::startsWith(config('app.url'), 'https'));
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
