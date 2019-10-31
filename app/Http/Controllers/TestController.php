<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function generate()
    {
        $questions = Question::randomQuestionWithAnswers();

        return $questions;
    }
}
