<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function random()
    {
        return Question::randomQuestionWithAnswers();
    }
}
