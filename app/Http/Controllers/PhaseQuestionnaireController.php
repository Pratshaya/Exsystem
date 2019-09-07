<?php

namespace App\Http\Controllers;

use App\Category;
use App\PhaseQuestionnaire;
use App\QuestionPhaseQuestionnaire;
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

    public function create(Questionnaire $questionnaire)
    {
        $phase_questionnaires = $questionnaire->phase_questionnaires;
        return view('phase_questionnaire.create')->with('phase_questionnaires', $phase_questionnaires)->with('questionnaire', $questionnaire);
    }

    public function store_phase(Request $request, Questionnaire $questionnaire){
        PhaseQuestionnaire::create([
            'name'=>$request->name,
            'questionnaire_id'=> $questionnaire->id
        ]);
        return redirect()->route('phase_questionnaire.create', $questionnaire->id);
 
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        //dd($request->options);

        foreach($request->questions as $question){
            QuestionPhaseQuestionnaire::create([
                'phase_questionnaire_id' => $request->phase_questionnaire_id,
                'name' => $question['name'],
                'group_questionnaire_id'=>$request->group_questionnaire_id
            ]);
        }
        
        //$phase_questionnaire->option_phase_questionnaires()->createMany($request->options);

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
        $options_question = $questionnaire->option_questionnaires;
        $phase_questionnaires = $questionnaire->phase_questionnaires;
        return view('phase_questionnaire.show')
        ->with('phase_questionnaires', $phase_questionnaires)
        ->with('questionnaire', $questionnaire)
        ->with('options_question',$options_question);
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
