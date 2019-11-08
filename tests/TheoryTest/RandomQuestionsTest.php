<?php

namespace Tests\Commands;

use App\Category;
use App\Http\Controllers\QuestionController;
use App\Question;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RandomQuestionsTest extends TestCase
{
    use DatabaseMigrations;

    private $response;

    public function setUp() : void
    {
        parent::setUp();

        factory(Category::class, 4)->create();
        factory(Question::class, 60)->state('with_answers')->create();

        $url = action([QuestionController::class, 'random']);

        $this->response = $this->json('get', $url);
    }

    /** @test */
    public function every_test_should_have_thirty_questions()
    {
        $this->response->assertJsonCount(30);
    }

    /** @test */
    public function it_should_return_questions_with_answers()
    {
        $this->response->assertJsonStructure([['id', 'title', 'image_url', 'answers' => ['*' => ['id', 'question_id', 'content', 'is_correct']]]]);
    }
}
