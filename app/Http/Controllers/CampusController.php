<?php

namespace App\Http\Controllers;

use App\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::paginate(10);
        return view('campus.index')->with('campuses', $campuses);
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
        Campus::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Campus created successfully');

        return redirect()->route('campus.index');
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
    public function edit(Campus $campus)
    {
        return view('campus.edit')->with('campus', $campus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campus $campus)
    {
        $campus->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'campus update successfully');

        return redirect()->route('campus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        if ($campus->departments->isEmpty()) {
            $campus->delete();
            session()->flash('success', 'Campus deleted successfully.');

        } else {
            session()->flash('error', 'Campus can not delete you must to delete all user.');
        }
        return redirect()->route('campus.index');
    }
}
