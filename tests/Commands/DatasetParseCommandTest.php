<?php

namespace Tests\Commands;

use App\Answer;
use App\Category;
use App\Question;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatasetParseCommandTest extends TestCase
{
    use RefreshDatabase;

    private $questionCount = 5;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('dataset:parse')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');
    }

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        $this->assertEquals(4, Category::count());
        $this->assertEquals($this->questionCount, Question::count());
        $this->assertEquals($this->questionCount * 4, Answer::count());
    }

    /** @test */
    public function it_should_store_questions_with_images()
    {
        $this->assertEquals(3, Question::WhereNotNull('image_url')->count());
    }

    /** @test */
    public function it_should_store_questions_with_images_in_a_local_folder()
    {
//        $this->assertFileExists();
    }

    /** @test */
    public function every_question_must_have_an_answer()
    {
        $this->assertEquals($this->questionCount,  Question::whereHas('correctAnswer')->count());
    }

    /** @test */
    public function it_should_create_one_correct_answer_for_every_question()
    {
        $this->assertEquals($this->questionCount,  Answer::where('is_correct', true)->count());
    }
}
