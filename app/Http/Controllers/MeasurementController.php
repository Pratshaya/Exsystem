<?php

namespace App\Http\Controllers;

use App\MeasurementPhaseQuestionnaire;
use App\MeasurementQuestionnaire;
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
    public function store(Request $request, Questionnaire $questionnaire)
    {
        if ($request->score_min >= $request->score_max) {
            session()->flash('error', 'Score Min can not more Score Max.');
        } else {
            if ($questionnaire->type == 'P') {
                MeasurementPhaseQuestionnaire::create([
                    'result' => $request->result,
                    'score_min' => $request->score_min,
                    'score_max' => $request->score_max,
                    'phase_questionnaire_id' => $request->phase_questionnaire_id
                ]);
            } elseif ($questionnaire->type == 'S') {
                MeasurementQuestionnaire::create([
                    'result' => $request->result,
                    'score_min' => $request->score_min,
                    'score_max' => $request->score_max,
                    'questionnaire_id' => $questionnaire->id
                ]);
            } elseif ($questionnaire->type == 'SP') {
                if ($request->phase_questionnaire_id == 0) {
                    //This For Measurement Sum
                    MeasurementQuestionnaire::create([
                        'result' => $request->result,
                        'score_min' => $request->score_min,
                        'score_max' => $request->score_max,
                        'questionnaire_id' => $questionnaire->id
                    ]);
                } else {
                    MeasurementPhaseQuestionnaire::create([
                        'result' => $request->result,
                        'score_min' => $request->score_min,
                        'score_max' => $request->score_max,
                        'phase_questionnaire_id' => $request->phase_questionnaire_id
                    ]);
                }
            }
            session()->flash('success', 'Measurement Questionnaire Created success.');
        }
        return redirect()->route('measurement_phase_questionnaire.show', $questionnaire->id);
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
        return view('measurement_phase_questionnaire.edit')->with('measurement', $measurement)->with('phase_questionnaires', $phase_questionnaires);
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
        // $measurement_next= MeasurementQuestionnaire::where('questionnaire_id',$measurement->questionnaire->id)->where('score_min',$measurement->score_max+1)->first();
        // if(!empty($measurement_next)){
        //     if($request->score_max >= $measurement_next->score_max){
        //         session()->flash('error', 'Measurement Questionnaire score max must less socre min in next.');
        //         $phase = PhaseQuestionnaire::find($request->phase_questionnaire_id);
        //         return redirect()->route('measurement_phase_questionnaire.show', $phase->questionnaire->id);
        //     }
        //     $measurement_next->update([
        //         'score_min' => $request->score_max+1
        //     ]);
        // }
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

    public function edit_questionnaire(MeasurementQuestionnaire $measurement)
    {
        return view('measurement_questionnaire.edit')
            ->with('measurement', $measurement);
    }
    public function update_questionnaire(Request $request, MeasurementQuestionnaire $measurement)
    {
        // $measurement_next= MeasurementQuestionnaire::where('questionnaire_id',$measurement->questionnaire->id)->where('score_min',$measurement->score_max+1)->first();
        // if(!empty($measurement_next)){
        //     $measurement_next->update([
        //         'score_min' => $request->score_max+1
        //     ]);
        // }
        $measurement->update($request->all());

        session()->flash('success', 'Measurement Questionnaire  update successfully');
        return redirect()->route('measurement_phase_questionnaire.show', $measurement->questionnaire);
    }
    public function destroy_questionnaire(MeasurementQuestionnaire $measurement)
    {
        $questionnaire = $measurement->questionnaire;
        $measurement->delete();
        session()->flash('success', 'MeasurementPhaseQuestionnaire Deleted success.');
        return redirect()->route('measurement_phase_questionnaire.show', $questionnaire->id);
    }
}
