<?php

namespace Tests\Commands;

use App\Category;
use App\Question;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GenerateRandomQuestionsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void
    {
        parent::setUp();

        factory(Category::class, 4)->create();
        factory(Question::class, 60)->state('with_answers')->create();
    }

    /** @test */
    public function every_test_should_have_thirty_questions()
    {
        $questionAmount = Question::select(['id'])->limit(30)->get()->count();

        $this->assertEquals(30, $questionAmount);
    }

    public function it_should_give_random_questions()
    {
        $questions = Question::select(['id'])->limit(30)->inRandomOrder()->get();

    }
}
