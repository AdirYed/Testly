<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Category;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'image_url' => null,
        'original_id' => $faker->unique()->numberBetween(1, 1800),
        'category_id' => $faker->numberBetween(1, 4),
    ];
})->afterCreatingState(Question::class, 'with_answers', function (Question $question, $faker) {
        factory(Answer::class, 3)->create([
            'question_id' => $question->id,
        ]);

        factory(Answer::class, 1)->create([
            'is_correct' => 1,
            'question_id' => $question->id,
        ]);
});
