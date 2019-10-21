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

    private $questionCount = 45;
    private $questionsWithImg = 15;

    /** @test */
    public function it_stores_categories_questions_and_answers()
    {
        $this->artisan('dataset:parse')
            ->expectsOutput('Dataset parsed and stored in the database successfully!');

        // Testing the command - Should add Categories, Questions and Answers. Each question should have 4 answers.
        $this->assertCount(4, Category::get()); // Should have only 4 permanent categories.
        $this->assertCount($this->questionCount, Question::get()); // Depends on how many questions were in the .xml file.
        $this->assertCount($this->questionCount * 4, Answer::get()); // Each question should have 4 answers.

        $this->assertEquals($this->questionsWithImg, $this->amountOfQuestionsWithImg()); // Checks the amount of questions with an image.
        $this->assertEquals($this->questionCount - $this->questionsWithImg, $this->amountOfQuestionsWithoutImg()); // Checks the amount of questions without an image.

        $this->assertEquals($this->questionCount, $this->amountOfCorrectAnswers()); // Checks whether each question has an answer.
    }

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
