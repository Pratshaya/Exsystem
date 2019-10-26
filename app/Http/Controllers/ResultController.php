<?php

namespace App\Http\Controllers;

use App\MeasurementQuiz;
use App\Result;
use App\User;
use ConsoleTVs\Charts\Builder\Chart;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereRoleIs('user')->paginate(10);
        return view('result.index')->with('users', $users);
    }

    public function result_show(User $user)
    {
        $results = $user->results()->orderBy('created_at')->get();
        $array_results = array();
        foreach ($results as $result){
            $array_results[$result->quiz->category_id][] = $result;

        }

        return view('result.result_show')->with('results', $array_results)->with('user', $user);
    }

    private function hashQuizUser($user)
    {
        $hash = array();
        foreach ($user->results()->orderBy('quiz_id')->get() as $result) {
            $hash['name'][] = $result->quiz->name;
            $hash['score'][] = $result->score;
        }
        return $hash;

    }

    public function chart(User $user)
    {
        if (!$user->results->isEmpty()) {
            $hashs = $this->hashQuizUser($user);
            $chart = Charts::create('line', 'highcharts')
                ->title("ผลการทดสอบ")
                ->labels($hashs['name'])
                ->values($hashs['score'])
                ->elementLabel("คะแนนที่ได้รับ");
        } else {
            $chart = '';
        }
        return view('result.chart')->with('chart', $chart);
    }

    public function result_questionnaire_show(User $user){
        $array_results = array();
        $results = $user->results_questionnaire()->with('result_phase_questionnaire', 'user', 'questionnaire')->orderBy('created_at')->get();
        foreach ($results as $result) {
            $array_results[$result->questionnaire->category_questionnaire_id][] = $result;
        }
        return view('result.result_questionnaire_show')->with('results',$array_results)->with('user',$user);
    }

}
