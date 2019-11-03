<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function random()
    {
        return Question::randomQuestionWithAnswers();
    }
}
