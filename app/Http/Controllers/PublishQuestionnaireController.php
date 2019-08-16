<?php

namespace App\Http\Controllers;

use App\PhaseQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;

class PublishQuestionnaireController extends Controller
{
    public function index()
    {

    }

    public function show(Questionnaire $questionnaire)
    {
        return view('publish_questionnaire.show')->with('questionnaire', $questionnaire);

    }

    public function public(PhaseQuestionnaire $phase)
    {

        $phase->update(['public' => !$phase->public]);
        return redirect()->route('publish_questionnaire.show', $phase->questionnaire);
    }
}
