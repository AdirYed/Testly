<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DrivingLicenseType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DrivingLicenseType query()
 * @mixin \Eloquent
 */
class DrivingLicenseType extends Model
{
    public $fillable = [
        'code',
        'name',
    ];
}
