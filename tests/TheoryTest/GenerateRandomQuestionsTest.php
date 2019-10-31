<?php

namespace Tests\Commands;

use App\Category;
use App\Http\Controllers\TestController;
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
        $url = action([TestController::class, 'generate']);

        $this->json('get', $url)
            ->assertJsonCount(30);
    }

    /** @test */
    public function it_should_return_questions_with_answers()
    {
        $url = action([TestController::class, 'generate']);

        $response = $this->json('get', $url);

        $response->assertJsonStructure([['id', 'title', 'answers' => ['*' => ['id', 'content']]]]);
    }
}
