<?php

namespace App\Http\Controllers;

use App\GroupQuestionnaire;
use App\Questionnaire;
use App\GroupOptionQuestionnaire;

use Illuminate\Http\Request;

class GroupQuestionnaireController extends Controller
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
    public function store(Request $request,Questionnaire $questionnaire)
    {
        $count = $questionnaire->option_questionnaires()->count();
        if(sizeof($request->scores)!= $count){
            return redirect()->route('group_questionnaire.show',$questionnaire->id);
        }

        $group = GroupQuestionnaire::create([
            'name' => $request->name,
            'questionnaire_id' => $questionnaire->id
        ]);

        foreach($request->scores as $key=>$score){
            GroupOptionQuestionnaire::create([
                'option_questionnaire_id' => $key,
                'score' => $score,
                'group_questionnaire_id' => $group->id
            ]);
        }

         return redirect()->route('group_questionnaire.show', $questionnaire);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupQuestionnaire  $groupQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        
        return view('group_questionnaire.show')->with('questionnaire', $questionnaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupQuestionnaire  $groupQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupQuestionnaire $groupQuestionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupQuestionnaire  $groupQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupQuestionnaire $groupQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupQuestionnaire  $groupQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupQuestionnaire $groupQuestionnaire)
    {
        //
    }
}
