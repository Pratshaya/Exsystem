<?php

namespace App\Http\Controllers;

use App\MeasurementQuize;
use App\Quize;
use Illuminate\Http\Request;

class MeasurementQuizeController extends Controller
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
    public function store(Request $request, Quize $quize)
    {
        if ($request->score_min >= $request->score_max) {
            session()->flash('error', 'Score Min can not more Score Max.');
        } else {
            if ($quize->type == 'T') {
                MeasurementPhaseQuestionnaire::create([
                    'result' => $request->result,
                    'score_min' => $request->score_min,
                    'score_max' => $request->score_max,
                    'phase_questionnaire_id' => $request->phase_questionnaire_id
                ]);
            }
            elseif ($quize->type == 'F') {
                MeasurementQuestionnaire::create([
                    'result' => $request->result,
                    'score_min' => $request->score_min,
                    'score_max' => $request->score_max,
                    'quize_id' => $quize->id
                ]);
            }
        session()->flash('success', 'Measurement Questionnaire Created success.');
        }
        return redirect()->route('measurement_quize.show', $quize->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function show(MeasurementQuize $measurementQuize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasurementQuize $measurementQuize)
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
    public function update(Request $request, MeasurementQuize $measurementQuize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeasurementQuize  $measurementQuize
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasurementQuize $measurementQuize)
    {
        //
    }
}
