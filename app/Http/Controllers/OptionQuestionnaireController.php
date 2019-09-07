<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\OptionQuestionnaire;
use App\GroupQuestionnaire;

class OptionQuestionnaireController extends Controller
{
    public function index(){

    }
    
    public function show(Questionnaire $questionnaire){
        return view('option_questionnaire.show')->with('questionnaire',$questionnaire);
    }

    public function store(Request $request, Questionnaire $questionnaire){
        OptionQuestionnaire::create([
            'option' => $request->option,
            'questionnaire_id' =>$questionnaire->id
        ]);
        return redirect()->route('option_questionnaire.show',$questionnaire->id);
    }

}
