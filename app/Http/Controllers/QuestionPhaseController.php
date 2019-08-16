<?php

namespace App\Http\Controllers;

use App\PhaseQuestionnaire;
use App\Questionnaire;
use App\QuestionPhaseQuestionnaire;
use Illuminate\Http\Request;

class QuestionPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::paginate(6);
        return view('question_phase_questionnaire.index')->with('questionnaires', $questionnaires);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PhaseQuestionnaire $phase)
    {
        return view('question_phase_questionnaire.create')->with('phase_questionnaire', $phase);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PhaseQuestionnaire $phase)
    {
        $phase->question_phase_questionnaires()->create([
            'name' => $request->name,
        ]);
        session()->flash('success', 'Create question success.');
        return redirect()->route('question_phase_questionnaire.create', $phase->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\QuestionPhaseQuestionnaire $questionPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $phase_questionnaires = $questionnaire->phase_questionnaires;
        return view('question_phase_questionnaire.show')->with('phase_questionnaires', $phase_questionnaires)->with('questionnaire', $questionnaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\QuestionPhaseQuestionnaire $questionPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionPhaseQuestionnaire $questionPhaseQuestionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\QuestionPhaseQuestionnaire $questionPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionPhaseQuestionnaire $questionPhaseQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\QuestionPhaseQuestionnaire $questionPhaseQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionPhaseQuestionnaire $questionPhaseQuestionnaire)
    {
        //
    }
}
