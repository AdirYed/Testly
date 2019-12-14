<?php

namespace Tests\Commands;

use App\Category;
use App\DrivingLicenseType;
use App\Http\Controllers\DrivingLicenseTypeQuestionController;
use App\Question;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RandomQuestionsTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() : void
    {
        parent::setUp();

        factory(Category::class, 4)->create();
        factory(Category::class, 1)->create(['is_bicycle' => 1]);

        factory(Question::class, 45)->states('with_answers')->create(['category_id' => 5]);
        factory(Question::class, 240)->states('with_answers')->create();
    }

    /** @test */
    public function every_test_should_have_thirty_questions()
    {
        foreach (DrivingLicenseType::get() as $drivingLicenseType) {
            $url = action([
                DrivingLicenseTypeQuestionController::class,
                'random',
            ], [
                'driving_license_type' => DrivingLicenseType::find($drivingLicenseType->id),
            ]);

            $response = $this->json('get', $url);

            $response->assertJsonCount(30, 'questions');
        }
    }

    /** @test */
    public function it_should_return_driver_license_type_and_questions_with_answers()
    {
        $rand = rand(1, DrivingLicenseType::count());

        $url = action([
            DrivingLicenseTypeQuestionController::class,
            'random',
        ], [
            'driving_license_type' => DrivingLicenseType::find($rand),
        ]);

        $response = $this->json('get', $url);

        $response->assertJsonStructure([
            'driving_license_type' => [
                'id',
                'code',
                'name',
            ],
            'questions' => [
                '*' => [
                    'id',
                    'title',
                    'image_url',
                    'formatted_image_url',
                    'answers' => [
                        '*' => [
                            'id',
                            'question_id',
                            'content',
                            'is_correct',
                        ],
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function it_filters_other_driving_license_type_questions()
    {
        $questions = Question::get();

        $rand = rand(1, DrivingLicenseType::count());

        $url = action([
            DrivingLicenseTypeQuestionController::class,
            'random',
        ], [
            'driving_license_type' => DrivingLicenseType::find($rand),
        ]);

        $response = $this->json('get', $url);

        foreach ($response->json()['questions'] as $question) {
            $this->assertEquals(1, $questions->where('id', $question['id'])->isNotEmpty());
        }
    }
}
