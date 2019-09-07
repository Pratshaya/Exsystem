<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\GroupOptionQuestionnaire;

class GroupOptionQuestionnaireController extends Controller
{
    public function store(Request $request, Questionnaire $questionnaire){
        GroupOptionQuestionnaire::create([
            'score' => $request->score,
            'option' => $request->option,
            'group_questionnaire_id' => $request->group_questionnaire_id
        ]);
    }
}
