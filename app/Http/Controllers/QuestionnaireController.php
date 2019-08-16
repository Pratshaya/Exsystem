<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryQuestionnaire;
use App\Questionnaire;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::paginate(6);
        $categories = CategoryQuestionnaire::all();

        return view('questionnaire.index')->with('questionnaires', $questionnaires)->with('categories', $categories);
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
        Questionnaire::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_questionnaire_id' => $request->category_id
        ]);
        session()->flash('success', 'Created Questionnaire success.');

        return redirect()->route('questionnaire.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        $categories = CategoryQuestionnaire::all();
        return view('questionnaire.edit')->with('questionnaire', $questionnaire)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        $questionnaire->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'category_questionnaire_id' => $request->category_id
        ]);

        session()->flash('success', 'Questionnaire update successfully');

        return redirect()->route('questionnaire.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        if ($questionnaire->phase_questionnaires->isEmpty()) {
            $questionnaire->delete();
            session()->flash('success', 'Questionnaire deleted successfully');
        } else {
            session()->flash('error', 'Questionnaire can not delete you must to delete all Phase Questionnaires.');
        }
        return redirect()->route('questionnaire.index');
    }
}
