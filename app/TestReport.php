<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\TestReport.
 *
 * @property int $id
 * @property bool $passed
 * @property int $wrong_answers
 * @property int $correct_answers
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $finished_at
 * @property array $test
 * @property int|null $user_id
 * @property int $driving_license_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereCorrectAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereDrivingLicenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport wherePassed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereWrongAnswers($value)
 * @mixin \Eloquent
 */
class TestReport extends Model
{
    protected $fillable = [
        'passed',
        'wrong_answers',
        'correct_answers',
        'started_at',
        'finished_at',
        'test',
        'user_id',
        'driving_license_type_id',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'test' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
