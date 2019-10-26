<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $branches = Branch::paginate(10);
        return view('branch.index')->with('branches', $branches)->with('departments', $departments );
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
        Branch::create([
            'name' => $request->name,
            'department_id' => $request->department_id
        ]);

        session()->flash('success', 'Branch created successfully');

        return redirect()->route('branch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branch.edit')->with('branch', $branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Branch update successfully');

        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        if ($branch->rooms->isEmpty()) {
            $branch->delete();
            session()->flash('success', 'Branch deleted successfully.');

        } else {
            session()->flash('error', 'Branch can not delete you must to delete all user.');
        }
        return redirect()->route('branch.index');
    }
}
