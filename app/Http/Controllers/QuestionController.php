<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Objective;
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
        $objectives = $quiz->objectives;
        $questions = $quiz->questions;
        if ($quiz->type == 'N')
            return view('question.show')->with('questions', $questions)->with('quiz', $quiz)->with('objectives', $objectives);
        return view('question.show_objective')->with('quiz', $quiz)->with('objectives', $objectives);
    }

    public function store(CreateQuestionRequest $request, Quiz $quiz)
    {
        if ($quiz->type == 'N') {
            $objectives = Objective::where('quiz_id', $quiz->id)->first();
            $question = $quiz->questions()->create([
                'name' => $request->name,
                'objective_id' => $objectives->id,
            ]);
        } else {
             $validate = $request->validate([
               'objective_id' => 'required|exists:objectives,id'
            ]);

            $question = $quiz->questions()->create([
                'name' => $request->name,
                'objective_id' => $request->objective_id,
            ]);
        }


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
