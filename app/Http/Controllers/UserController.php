<?php

namespace App\Http\Controllers;


use App\Department;
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
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
       // Auth::user()->hasRole('user', 'admindepartment', 'adminteacher')->where('department_id',Auth::);
        if(Auth::user()->hasRole('administrator')){
            $model = $model->orWhereRoleIs('administrator')->orWhereRoleIs('adminfaculty')
                ->orWhereRoleIs('admindepartment')->orWhereRoleIs('adminteacher')->orWhereRoleIs('user');
            $model = $model->where('department_id',Auth::user()->department_id);
        }
        if(Auth::user()->hasRole('adminfaculty')){
            $model = $model->WhereRoleIs('adminfaculty')
                ->orWhereRoleIs('admindepartment')->orWhereRoleIs('adminteacher')->orWhereRoleIs('user');
            $model = $model->where('department_id',Auth::user()->department_id);
        }
        if(Auth::user()->hasRole('admindepartment')){
            $model = $model->WhereRoleIs('admindepartment')
                ->orWhereRoleIs('adminteacher')->orWhereRoleIs('user');
            $model = $model->where('department_id',Auth::user()->department_id);
        }
        if(Auth::user()->hasRole('adminteacher')){
            $model = $model->WhereRoleIs('adminteacher')->orWhereRoleIs('user');
            $model = $model->where('department_id',Auth::user()->department_id);
        }
        $model = $model->where('department_id',Auth::user()->department_id);
        return view('users.index', ['users' => $model->get()]);
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
        $roles = Role::all();
        return view('users.create')->with('rooms', $rooms)->with('departments', $departments)
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
        $model->create($request->merge(['password' => Hash::make($request->get('card'))])->all());
        User::create([
            'name' => $request->name,
            'std_id' => $request->std_id,
            'room_id' => $request->room_id,
            'department_id' => $request->department_id,
        ]);
        $model->attachRole($request->role_id);
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
