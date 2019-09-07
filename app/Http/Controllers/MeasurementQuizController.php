<?php

namespace App\Http\Controllers;

use App\MeasurementQuiz;
use App\Quiz;
use Illuminate\Http\Request;

class MeasurementQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Quiz $quiz)
    {
        if ($request->score_min >= $request->score_max) {
            session()->flash('error', 'Score Min can not more Score Max.');
        } else {
            MeasurementQuiz::create([
                'result' => $request->result,
                'score_min' => $request->score_min,
                'score_max' => $request->score_max,
                'quiz_id' => $quiz->id
            ]);
        session()->flash('success', 'Measurement Quiz Created success.');
        }
        return redirect()->route('measurement_quiz.show', $quiz->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('measurement_quiz.show')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasurementQuiz $measurementQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeasurementQuiz $measurementQuiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasurementQuiz $measurementQuiz)
    {
        //
    }
}
