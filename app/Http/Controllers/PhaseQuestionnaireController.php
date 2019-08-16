<?php

namespace App\Http\Controllers;

use App\Category;
use App\PhaseQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;

class PhaseQuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::paginate(6);
        return view('phase_questionnaire.index')->with('questionnaires', $questionnaires);
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


    public function store(Request $request, Questionnaire $questionnaire)
    {
        //dd($request->options);
        $phase_questionnaire = $questionnaire->phase_questionnaires()->create([
            'name' => $request->name,
            'detail' => $request->detail
        ]);
        //dd($request->questions);
        $phase_questionnaire->question_phase_questionnaires()->createMany($request->questions);
        $phase_questionnaire->option_phase_questionnaires()->createMany($request->options);

        session()->flash('success', 'Create phase success.');
        return redirect()->route('phase_questionnaire.show', $questionnaire->id);
    }

    public function option_store(Request $request, PhaseQuestionnaire $phase_questionnaire)
    {

        $phase_questionnaire->option_phase_questionnaires()->createMany($request->options);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\PhaseQuestionnaire $phaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $phase_questionnaires = $questionnaire->phase_questionnaires;
        return view('phase_questionnaire.show')->with('phase_questionnaires', $phase_questionnaires)->with('questionnaire', $questionnaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PhaseQuestionnaire $phaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(PhaseQuestionnaire $phaseQuestionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PhaseQuestionnaire $phaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhaseQuestionnaire $phaseQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PhaseQuestionnaire $phaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhaseQuestionnaire $phaseQuestionnaire)
    {
        $questionnaire = $phaseQuestionnaire->questionnaire;
        $phaseQuestionnaire->question_phase_questionnaires()->delete();
        $phaseQuestionnaire->option_phase_questionnaires()->delete();
        $phaseQuestionnaire->delete();
        session()->flash('success', 'Deleted phase success.');
        return redirect()->route('phase_questionnaire.show', $questionnaire->id);
    }
}
