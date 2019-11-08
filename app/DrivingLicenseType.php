<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\DrivingLicenseType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DrivingLicenseType extends Model
{
    public $fillable = [
        'code',
        'name',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}
