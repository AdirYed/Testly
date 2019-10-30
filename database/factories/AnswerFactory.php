<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'is_correct' => 0,
        'question_id' => 0,
    ];
});
