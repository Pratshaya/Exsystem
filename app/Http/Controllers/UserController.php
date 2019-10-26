<?php

namespace App\Http\Controllers;


use App\Department;
use App\Faculty;
use App\Branch;
use App\Role;
use App\Room;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param \App\User $model
     * @return \Illuminat\View\View
     */
    public function index()
    {
        $users= User::whereRole();
        return view('users.index', ['users' => $users])->with(Auth::user()->department_id);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rooms = Room::all();
        $departments = Department::all();
        $branches = Branch::all();
        $roles = Role::all();
        return view('users.create')
            ->with('rooms', $rooms)
            ->with('departments', $departments)
            ->with('branches', $branches)
            ->with('roles', $roles);
    }

    /**
     * Store a newly created user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
       // $model->create($request->merge(['password' => Hash::make($request->get('card'))])->all());
        $user = User::create([
            'email'=> $request->email,
            'name' => $request->name,
            'card' => $request->card,
            'std_id' => $request->std_id,
            'room_id' => $request->room_id,
            'department_id' => $request->department_id,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->get('card')),
            'faculty_id' => $request->faculty_id,
            'campus_id' => $request->campus_id
        ]);
        if(!empty($request->role_id)) {
            $user->attachRole($request->role_id);
        }else{
            $user->attachRole(2);
        }

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
                ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }


}
