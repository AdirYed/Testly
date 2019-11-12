<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DrivingLicenseType;
use Faker\Generator as Faker;

$factory->define(DrivingLicenseType::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->bothify('**'),
        'name' => $faker->unique()->text(10),
    ];
});
