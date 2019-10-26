<?php

namespace App\Http\Controllers;

use App\Objective;
use App\Quiz;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objectives = Objective::paginate(10);
        return view('objective.index')->with('objectives', $objectives);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Quiz $quiz)
    {

        return view('objective.index')->with('quiz', $quiz)->with('objectives' ,$quiz->objectives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Quiz $quiz)
    {
        Objective::create([
            'name' => $request->name,
            'quiz_id' => $quiz->id,
        ]);

        session()->flash('success', 'Objective created successfully');

        return redirect()->route('objective.create',$quiz->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Objective $objective)
    {
        $quiz = Quiz::all();
        return view('objective.edit')->with('objective', $objective)->with('quiz',$quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objective $objective)
    {
        $objective->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'objective update successfully');

        return redirect()->route('objective.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objective $objective)
    {
        /*$objective->delete();
        session()->flash('success', 'Quiz deleted successfully.');*/
        if ($objective->questions->isEmpty()) {
            $objective->delete();
            session()->flash('success', 'Objective deleted successfully.');

        } else {
            session()->flash('error', 'Objective can not delete you must to delete all user.');
        }
        return redirect()->route('objective.create',$quiz->id);
    }
}
