<?php

namespace Tests\Commands;

use App\Answer;
use App\Category;
use App\Question;
use phpDocumentor\Reflection\Types\Parent_;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatasetParseCommandTest extends TestCase
{
    use RefreshDatabase;

    private $questionCount = 45;
    private $questionsWithImg = 15;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('dataset:parse')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');
    }

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        // Testing the command - Should add Categories, Questions and Answers. Each question should have 4 answers.
        $this->assertCount(4, Category::get()); // Should have only 4 permanent categories.
        $this->assertCount($this->questionCount, Question::get()); // Depends on how many questions were in the .xml file.
        $this->assertCount($this->questionCount * 4, Answer::get()); // Each question should have 4 answers.
    }

    /** @test */
    public function checks_if_the_question_has_an_image()
    {
        $this->assertEquals($this->questionsWithImg, $this->amountOfQuestionsWithImg()); // Checks the amount of questions with an image.
    }

    /** @test */
    public function checks_if_the_question_does_not_have_an_image()
    {
        $this->assertEquals($this->questionCount - $this->questionsWithImg, $this->amountOfQuestionsWithoutImg()); // Checks the amount of questions without an image.
    }

    /** @test */
    public function every_question_must_have_an_answer()
    {
        $this->assertEquals($this->questionCount, $this->amountOfCorrectAnswers()); // Checks whether each question has an answer.
    }

    // Methods
    protected function amountOfCorrectAnswers() : int
    {
        return Question::get()->each(function (Question $question, int $curr) {
            if (! $question->getCorrectAnswer()) {
                throw new \Exception("Question #{$curr} has no correct answer!");
            }
        })->count();
    }

    protected function amountOfQuestionsWithImg() : int
    {
        $amount = 0;

        foreach (Question::get() as $question) {
            if ($question->image_url) {
                $amount++;
            }
        }

        return $amount;
    }

    protected function amountOfQuestionsWithoutImg() : int
    {
        $amount = 0;

        foreach (Question::get() as $question) {
            if (!$question->image_url) {
                $amount++;
            }
        }

        return $amount;
    }
}
