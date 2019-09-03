<?php

namespace App\Http\Controllers;

use App\CategoryQuestionnaire;
use App\Http\Requests\PhaseQuestionnaire\CreatePhaseQuestionnaireRequest;
use App\Http\Requests\Questionnaire\CreateQuestionnaireRequest;
use App\MeasurementPhaseQuestionnaire;
use App\MeasurementQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;

class StepQuestionnaireController extends Controller
{
    public function index()
    {
        $categories = CategoryQuestionnaire::all();
        return view('step_questionnaire.create_category')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $questionnaire = Questionnaire::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_questionnaire_id' => $request->category_questionnaire_id,
            'type' => $request->type
        ]);

        $phase_questionnaire = $questionnaire->phase_questionnaires()->create([
            'name' => $request->name,
            'detail' => $request->detail
        ]);
        //dd($request->questions);
        $phase_questionnaire->question_phase_questionnaires()->createMany($request->questions);
        $phase_questionnaire->option_phase_questionnaires()->createMany($request->options);

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

            //This For Measurement Sum
            MeasurementQuestionnaire::create([
                'result' => $request->result,
                'score_min' => $request->score_min,
                'score_max' => $request->score_max,
                'questionnaire_id' => $questionnaire->id
            ]);

            MeasurementPhaseQuestionnaire::create([
                'result' => $request->result,
                'score_min' => $request->sum_score_min,
                'score_max' => $request->sum_score_max,
                'phase_questionnaire_id' => $request->phase_questionnaire_id
            ]);

        }
    }

    public function stepFirst()
    {
        $categories = CategoryQuestionnaire::all();
        return view('step_questionnaire.create_step_first')->with('categories', $categories);
    }

    public function storeFirst(CreateQuestionnaireRequest $request)
    {
        $questionnaire = Questionnaire::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_questionnaire_id' => $request->category_questionnaire_id,
            'type' => $request->type
        ]);
        return redirect()->route('step_questionnaire.step_two', $questionnaire);
    }

    public function stepTwo(Questionnaire $questionnaire)
    {
        $phase_questionnaires = $questionnaire->phase_questionnaires;
        return view('step_questionnaire.create_step_two')->with('phase_questionnaires', $phase_questionnaires)->with('questionnaire', $questionnaire);
    }

    public function storeTwo(CreatePhaseQuestionnaireRequest $request, Questionnaire $questionnaire)
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
        return redirect()->route('step_questionnaire.step_two', $questionnaire->id);
    }

    public function stepThree(Questionnaire $questionnaire)
    {
        return view('step_questionnaire.create_step_three')->with('questionnaire', $questionnaire);
    }

    public function storeThree(Request $request, Questionnaire $questionnaire)
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
        return redirect()->route('step_questionnaire.step_three', $questionnaire->id);
    }

    public function stepFour(Questionnaire $questionnaire)
    {
        return view('step_questionnaire.create_step_four')->with('questionnaire', $questionnaire);
    }

}
