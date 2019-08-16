<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryQuestionnaire;
use App\Option;
use App\OptionPhaseQuestionnaire;
use App\PhaseQuestionnaire;
use App\Post;
use App\Question;
use App\Questionnaire;
use App\QuestionPhaseQuestionnaire;
use App\Quiz;
use App\Result;
use App\ResultDetail;
use App\ResultDetailQuestionnaire;
use App\ResultPhaseQuestionnaire;
use App\ResultQuestionnaire;
use App\Slider;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $query = Quiz::has('questions', '>=', 1)->paginate(6);

        $questionnaires = Questionnaire::whereHas('phase_questionnaires', function ($query) {
            $query->where('public', '=', true);
        })->paginate(6);

        $sliders = Slider::has('status', '=', 1)->get();
        $posts = Post::paginate(6);
        $categories = Category::all();
        return view('student.index')->with('quizzes', $query)
            ->with('categories', $categories)
            ->with('posts', $posts)
            ->with('sliders', $sliders)
            ->with('questionnaires', $questionnaires);
    }

    public function index_category(Category $category)
    {
        $categories = Category::all();
        return view('student.quizzes')->with('quizzes', $category->quizzes()->has('questions', '>=', 1)->paginate(10))->with('categories', $categories)->with('category', $category);
    }

    public function quizzes()
    {
        $quizzes = Quiz::has('questions', '>=', 1)->paginate(20);
        $categories = Category::all();
        return view('student.quizzes')->with('quizzes', $quizzes)->with('categories', $categories);
    }

    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('student.show')->with('quiz', $quiz)->with('questions', $questions);
    }

    public function show_questionnaire(Questionnaire $questionnaire)
    {
        $phase_questionnaires = $questionnaire->phase_questionnaires->where('public', true);
        return view('student.show_questionnaire')
            ->with('questionnaire', $questionnaire)
            ->with('phase_questionnaires', $phase_questionnaires);
    }

    public function store_questionnaire(Request $request, Questionnaire $questionnaire)
    {

        if (empty($request->answers)) {
            $request->answers = [];
        }

        $count = ResultQuestionnaire::where('questionnaire_id', $questionnaire->id)->where('user_id', Auth::id())->count();
        $num = 1;
        if ($count > 0) {
            $num = $count + 1;
        }

        $result = ResultQuestionnaire::create([
            'user_id' => Auth::id(),
            'questionnaire_id' => $questionnaire->id,
            'num' => $num
        ]);
        $sum_result = 0;
        foreach ($request->answers as $phase => $answers) {
            $sum = 0;
            foreach ($answers as $question => $option) {
                $option = OptionPhaseQuestionnaire::find($option);
                $sum += $option->score;
            }

            $result_phase = ResultPhaseQuestionnaire::create([
                'result_questionnaire_id' => $result->id,
                'phase_questionnaire_id' => $phase,
                'score' => $sum
            ]);

            foreach ($answers as $question => $option) {
                ResultDetailQuestionnaire::create([
                    'result_phase_questionnaire_id' => $result_phase->id,
                    'question_phase_questionnaire_id' => $question,
                    'option_phase_questionnaire_id' => $option
                ]);
            }
            $sum_result += $sum;

        }
        $result->update(['score' => $sum_result]);

        session()->flash('success', 'ทำแบบสอบถามสำเร็จแล้ว');
        return redirect()->route('student.result_all_questionnaire');
    }

    public function store(Request $request, Quiz $quiz)
    {
        $score = 0;
        if (empty($request->ch)) {
            $request->ch = [];
        }
        foreach ($request->ch as $ch) {
            $option = Option::find($ch);
            $score += $option->score;
        }
        $count = Result::where('quiz_id', $quiz->id)->where('user_id', Auth::id())->count();
        $num = 1;
        if ($count > 0) {
            $num = $count + 1;
        }
        $result = Result::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'num' => $num
        ]);

        foreach ($quiz->questions as $question) {
            if (!empty($request->ch[$question->id])) {
                ResultDetail::create([
                    'result_id' => $result->id,
                    'question_id' => $question->id,
                    'option_id' => $request->ch[$question->id]
                ]);
            }
        }
        session()->flash('success', 'ทำข้อสอบสำเร็จแล้ว');
        return redirect()->route('student.result_all');
    }

    public function result_all()
    {
        $categories = Category::all();
        $results = Auth::user()->results()->orderBy('created_at')->get();
        $array_results = array();
        foreach ($results as $result) {
            $array_results[$result->quiz->category_id][] = $result;
        }

        return view('student.result_show')->with('results', $array_results)->with('categories', $categories);
    }

    public function result_all_questionnaire()
    {
        $array_results = array();
        $results = Auth::user()->results_questionnaire()
            ->with('result_phase_questionnaire', 'user', 'questionnaire')->orderBy('created_at')->get();
        foreach ($results as $result) {
            $array_results[$result->questionnaire->category_questionnaire_id][] = $result;
        }
        return view('student.result_all_questionnaire')->with('results', $array_results);
    }

    public function posts()
    {
        $posts = Post::paginate(15);
        return view('student.posts')->with('posts', $posts);
    }

    public function post(Post $post)
    {
        return view('student.post')->with('post', $post);
    }

    public function result_quiz(Result $result)
    {
        if ($result->user->id != Auth::id()) {
            return redirect()->route('student.result_all');
        }
        return view('student.result_quiz')->with('quiz', $result->quiz)
            ->with('questions', $result->quiz->questions)
            ->with('result_detail', $result->result_details);
    }

    public function result_questionnaire(ResultQuestionnaire $result_questionnaire)
    {
        if ($result_questionnaire->user->id != Auth::id()) {
            return redirect()->route('student.result_all_questionnaire');
        }
        return view('student.result_questionnaire')->with('result', $result_questionnaire)
            ->with('phase_questionnaires', $result_questionnaire->result_phase_questionnaire);

    }

}
