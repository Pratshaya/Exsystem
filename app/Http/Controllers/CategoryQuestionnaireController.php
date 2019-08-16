<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryQuestionnaire;
use Illuminate\Http\Request;

class CategoryQuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryQuestionnaire::paginate(10);
        return view('category_questionnaire.index')->with('categories', $categories);
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
        CategoryQuestionnaire::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category created successfully');

        return redirect()->route('category_questionnaire.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CategoryQuestionnaire $categoryQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryQuestionnaire $categoryQuestionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CategoryQuestionnaire $categoryQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryQuestionnaire $category_questionnaire)
    {
        return view('category_questionnaire.edit')->with('category', $category_questionnaire);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CategoryQuestionnaire $categoryQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryQuestionnaire $category_questionnaire)
    {
        $category_questionnaire->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Category update successfully');

        return redirect()->route('category_questionnaire.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CategoryQuestionnaire $categoryQuestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryQuestionnaire $category_questionnaire)
    {
        if ($category_questionnaire->questionnaires->isEmpty()) {
            $category_questionnaire->delete();
            session()->flash('success', 'Category deleted successfully.');

        } else {
            session()->flash('error', 'Category can not delete you must to delete all Questionnaire.');
        }
        return redirect()->route('category_questionnaire.index');
    }
}
