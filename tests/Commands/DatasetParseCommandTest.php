<?php

namespace Tests\Commands;

use App\Answer;
use App\Category;
use App\Question;
use Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 *  run "vendor\bin\paratest"
 */

class DatasetParseCommandTest extends TestCase
{
    use RefreshDatabase;

    private $questionCount = 5;

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        $this->artisan('dataset:parse --without-store')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        $this->assertEquals(4, Category::count());
        $this->assertEquals($this->questionCount, Question::count());
        $this->assertEquals($this->questionCount * 4, Answer::count());
    }

    /** @test */
    public function it_should_store_questions_with_images()
    {
        $this->artisan('dataset:parse --without-store')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        $this->assertEquals(1, Question::WhereNotNull('image_url')->count());
    }

    /**
     * @group slow
     */
    /** @test */
    public function it_should_store_images_in_a_local_storage()
    {
        Storage::fake('local');

        $this->artisan('dataset:parse')
            ->expectsOutput("\n" . 'All of the images were stored successfully!');

        $img = Question::whereNotNull('image_url')->first()->only('image_url');

        Storage::disk('local')->assertExists($img);
    }

    /** @test */
    public function every_question_must_have_an_answer()
    {
        $this->artisan('dataset:parse --without-store')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        $this->assertEquals($this->questionCount,  Question::whereHas('correctAnswer')->count());
    }

    /** @test */
    public function it_should_create_one_correct_answer_for_every_question()
    {
        $this->artisan('dataset:parse --without-store')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        $this->assertEquals($this->questionCount,  Answer::where('is_correct', true)->count());
    }
}
