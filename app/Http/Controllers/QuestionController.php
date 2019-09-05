<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::paginate(6);
        return view('question.index')->with('quizzes', $quizzes);
    }


    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('question.show')->with('questions', $questions)->with('quiz', $quiz);
    }

    public function show_match(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('question_match.show')->with('questions', $questions)->with('quiz', $quiz);
    }

    public function store(CreateQuestionRequest $request, Quiz $quiz)
    {
        $question = $quiz->questions()->create([
            'name' => $request->name,
        ]);

        $question->options()->createMany($request->options);

        return redirect()->route('question.show', $quiz);
    }

    public function destroy(Question $question)
    {
        $quiz = $question->quiz;
        $question->options()->delete();
        $question->delete();
        session()->flash('success', 'Question deleted successfully');
        return redirect()->route('question.show', $quiz);
    }
}
