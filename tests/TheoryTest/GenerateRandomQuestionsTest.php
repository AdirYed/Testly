<?php

namespace Tests\Commands;

use App\Question;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenerateRandomQuestionsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        $this->artisan('dataset:parse --without-store')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');
    }

    /** @test */
    public function every_test_should_have_thirty_questions()
    {
        $questions = Question::get();

        dd($questions);
    }
}
