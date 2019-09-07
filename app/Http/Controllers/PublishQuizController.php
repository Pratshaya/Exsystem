<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class PublishQuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        return view('publish_quiz.show')->with('quiz', $quiz);
    }
    public function publish(Request $request, Quiz $quiz)
    {
        $quiz->update(['publish' => !$quiz->publish]);
        return redirect()->route('publish_quiz.show', $quiz->id);
    }
}
