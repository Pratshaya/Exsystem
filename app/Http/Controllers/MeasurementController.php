<?php

namespace App\Http\Controllers;

use App\MeasurementPhaseQuestionnaire;
use App\PhaseQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->score_min >= $request->score_max) {
            session()->flash('error', 'Score Min can not more Score Max.');
        } else {
            MeasurementPhaseQuestionnaire::create([
                'result' => $request->result,
                'score_min' => $request->score_min,
                'score_max' => $request->score_max,
                'phase_questionnaire_id' => $request->phase_questionnaire_id
            ]);
            session()->flash('success', 'MeasurementPhaseQuestionnaire Created success.');
        }
        $phase = PhaseQuestionnaire::find($request->phase_questionnaire_id);
        return redirect()->route('measurement_phase_questionnaire.show', $phase->questionnaire->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\MeasurementPhaseQuestionnaire $measurementPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {

        return view('measurement_phase_questionnaire.show')->with('questionnaire', $questionnaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\MeasurementPhaseQuestionnaire $measurementPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasurementPhaseQuestionnaire $measurement)
    {
        $phase_questionnaires = $measurement->phase_questionnaire->questionnaire->phase_questionnaires;
        return view('measurement_phase_questionnaire.edit')->with('measurement', $measurement)->with('phase_questionnaires',$phase_questionnaires);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\MeasurementPhaseQuestionnaire $measurementPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeasurementPhaseQuestionnaire $measurement)
    {
        $measurement->update($request->all());
        session()->flash('success', 'MeasurementPhaseQuestionnaire  update successfully');
        $phase = PhaseQuestionnaire::find($request->phase_questionnaire_id);
        return redirect()->route('measurement_phase_questionnaire.show', $phase->questionnaire->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MeasurementPhaseQuestionnaire $measurementPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasurementPhaseQuestionnaire $measurement)
    {
        $phase = $measurement->phase_questionnaire;
        $measurement->delete();
        session()->flash('success', 'MeasurementPhaseQuestionnaire Deleted success.');
        return redirect()->route('measurement_phase_questionnaire.show', $phase->questionnaire->id);

    }
}
