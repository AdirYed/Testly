<?php

namespace Tests\Commands;

use App\Answer;
use App\Category;
use App\DrivingLicenseType;
use App\Question;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DatasetParseCommandTest extends TestCase
{
    use DatabaseTransactions;

    private $questionCount = 10;

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        $this->artisan('dataset:parse --without-images')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        $this->assertEquals(5, Category::count());
        $this->assertEquals($this->questionCount, Question::count());
        $this->assertEquals($this->questionCount * 4, Answer::count());
    }

    /** @test */
    public function it_should_store_questions_with_images()
    {
        $this->artisan('dataset:parse --without-images');

        $this->assertEquals(1, Question::whereNotNull('image_url')->count());
    }

    /**
     * @group slow
     */
    /** @test */
    public function it_should_store_images_in_a_local_storage()
    {
        Storage::fake('local');

        $this->artisan('dataset:parse')
            ->expectsOutput('All of the images were stored successfully!');

        Storage::assertExists('public/' . Question::whereNotNull('image_url')->firstOrFail()->image_url);
    }

    /** @test */
    public function every_question_should_have_one_correct_answer()
    {
        $this->artisan('dataset:parse --without-images');

        $this->assertEquals($this->questionCount, Question::whereHas('correctAnswer')->count());
    }

    /** @test */
    public function every_question_should_have_four_answers()
    {
        $this->artisan('dataset:parse --without-images');

        Question::withCount('answers')->each(function (Question $question): void {
            $this->assertEquals(4, $question->answers_count);
        });
    }

    /** @test */
    public function every_question_is_associated_with_driving_license_type()
    {
        $this->artisan('dataset:parse --without-images');

        $this->assertFalse(Question::doesntHave('drivingLicenseTypes')->exists());
    }

    /** @test */
    public function driving_license_type_has_at_least_one_question()
    {
        $this->artisan('dataset:parse --without-images');

        $this->assertFalse(DrivingLicenseType::doesntHave('questions')->exists());
    }
}
