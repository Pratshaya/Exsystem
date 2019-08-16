<?php

namespace App\Http\Controllers;

use App\MatchingOption;
use App\Quiz;
use Illuminate\Http\Request;

class MatchOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$quizzes = Quiz::where('',)->paginate(6);
        return view('question.index')->with('quizzes', $quizzes);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MatchingOption  $matchingOption
     * @return \Illuminate\Http\Response
     */
    public function show(MatchingOption $matchingOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MatchingOption  $matchingOption
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchingOption $matchingOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MatchingOption  $matchingOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchingOption $matchingOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MatchingOption  $matchingOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchingOption $matchingOption)
    {
        //
    }
}
