<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\TestReport
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $finished_at
 * @property int|null $user_id
 * @property int $driving_license_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TestReportAnswer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereDrivingLicenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUserId($value)
 * @mixin \Eloquent
 */
class TestReport extends Model
{
    protected $fillable = [
        'started_at',
        'finished_at',
        'user_id',
        'driving_license_type_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(TestReportAnswer::class);
    }
}
