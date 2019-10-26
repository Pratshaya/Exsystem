<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Objective;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::paginate(10);
        $departments = Department::all();
        $users = Auth::user();
        $categories = Category::all();
        return view('quiz.index')->with('quizzes', $quizzes)->with('categories', $categories)
            ->with('departments', $departments)
            ->with('users', $users);
    }

    public function store(CreateQuizRequest $request, User $user)
    {
        if ($user->hasRole('superadministrator')) {
            $quiz = Quiz::create([
                'name' => $request->name,
                'detail' => $request->detail,
                'category_id' => $request->category_id,
                'department_id' => $request->department_id,
                'type' => $request->type . ''
            ]);
        } else {
            $quiz = Quiz::create([
                'name' => $request->name,
                'detail' => $request->detail,
                'category_id' => $request->category_id,
                'department_id' => Auth::user()->department_id,
                'type' => $request->type . ''
            ]);
        }
        if ($request->type == 'N') {
            Objective::create([
                'quiz_id' => $quiz->id,
                'name' => 'ไม่มีวัตถุประสงค์'
            ]);
        }
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
