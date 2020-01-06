<?php

namespace Tests\TheoryTest;

use App\Category;
use App\DrivingLicenseType;
use App\Http\Controllers\DrivingLicenseTypeQuestionController;
use App\Question;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RandomQuestionsTest extends TestCase
{
    use DatabaseTransactions;

    /** @var DrivingLicenseType */
    private $driverLicenseType1;

    /** @var DrivingLicenseType */
    private $driverLicenseType2;

    /** @var Question[]|Collection */
    private $driverLicenseType1Questions;

    /** @var Question[]|Collection */
    private $driverLicenseType2Questions;

    public function setUp() : void
    {
        parent::setUp();

        $this->driverLicenseType1 = factory(DrivingLicenseType::class)->create();
        $this->driverLicenseType2 = factory(DrivingLicenseType::class)->create();

        factory(Category::class, 4)->create();

        $this->driverLicenseType1Questions = factory(Question::class, 60)->states('with_answers')->create();
        $this->driverLicenseType2Questions = factory(Question::class, 60)->states('with_answers')->create();

        $this->driverLicenseType1->questions()->attach($this->driverLicenseType1Questions);
        $this->driverLicenseType2->questions()->attach($this->driverLicenseType2Questions);
    }

    /** @test */
    public function every_test_should_have_thirty_questions()
    {
        $url = action([
            DrivingLicenseTypeQuestionController::class,
            'random',
        ], [
            'driving_license_type' => $this->driverLicenseType1,
        ]);
        $response = $this->json('get', $url);
        $response->assertJsonCount(30, 'questions');
    }

    /** @test */
    public function it_should_return_driver_license_type_and_questions_with_answers()
    {
        $url = action([
            DrivingLicenseTypeQuestionController::class,
            'random',
        ], [
            'driving_license_type' => $this->driverLicenseType1,
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
                    'pivot' => [
                        'driving_license_type_id',
                        'question_id',
                    ],
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
        $url = action([
            DrivingLicenseTypeQuestionController::class,
            'random',
        ], [
            'driving_license_type' => $this->driverLicenseType2,
        ]);
        $response = $this->json('get', $url);
        foreach ($response->json()['questions'] as $question) {
            $this->assertEquals(1, $this->driverLicenseType2Questions->where('id', $question['id'])->isNotEmpty());
        }
    }
}
