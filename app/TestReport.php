<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\TestReport
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport query()
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
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
