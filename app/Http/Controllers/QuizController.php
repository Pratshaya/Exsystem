<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::paginate(10);
        $categories = Category::all();
        return view('quiz.index')->with('quizzes', $quizzes)->with('categories', $categories);
    }

    public function store(CreateQuizRequest $request)
    {
        Quiz::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_id' => $request->category_id
        ]);
        session()->flash('success', 'Created Quiz success.');

        return redirect()->route('quiz.index');
    }

    public function edit(Quiz $quiz)
    {
        $categories = Category::all();
        return view('quiz.edit')->with('quiz', $quiz)->with('categories', $categories);
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $quiz->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_id' => $request->category_id
        ]);

        session()->flash('success', 'Quiz update successfully');

        return redirect()->route('quiz.index');
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->questions->isEmpty()) {
            $quiz->delete();
            session()->flash('success', 'Quiz deleted successfully');
        } else {
            session()->flash('error', 'Quiz can not delete you must to delete all question.');
        }
        return redirect()->route('quiz.index');

    }
}
