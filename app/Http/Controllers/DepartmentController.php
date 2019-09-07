<?php

namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use http\Env\Response;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        $departments = Department::paginate(10);
        return view('department.index')->with('departments', $departments)->with('faculties', $faculties);
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
        Department::create([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id
        ]);

        session()->flash('success', 'Department created successfully');

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit')->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Department update successfully');

        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if ($department->rooms->isEmpty()) {
            $department->delete();
            session()->flash('success', 'Department deleted successfully.');

        } else {
            session()->flash('error', 'Department can not delete you must to delete all user.');
        }
        return redirect()->route('department.index');
    }

    //Ajax
    public function ajax_rooms(Department $department)
    {
        return Response()->json($department->rooms);
    }
}
