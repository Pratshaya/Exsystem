<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Imports\UsersImport;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Empty_;

class ImportStudentController extends Controller
{
    public function import()
    {
        $departments = Department::auth();
        $branches = Branch::all();
        $rooms = Room::all();
        return view('users.import')->with('rooms', $rooms)->with('departments',$departments)
            ->with('branches',$branches);
    }

    public function import_file(Request $request)
    {
        $validator1 = Validator::make(
            [
              //  'file' => $request->file,
                'room_id' => $request->room_id
            ],
            [
             //   'file' => 'required|mimes:xlsx',
                'room_id' => 'exists:rooms,id'
            ]
        );
        $error = false;
        if (!$validator1->fails()) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path)->get()->toArray();
            $users_old = array();
            $error_message = array();
            $i = 1;
            foreach ($data as $user) {
                if(empty($user['name'])){
                    break;
                }
                foreach ($users_old as $user_old) {
                    if ($user_old['std_id'] == $user['std_id']) {
                        $error_message[$i][] = 'รหัสนักเรียนซ้ำ';
                        $error = true;
                    }
                    if ($user_old['email'] == $user['email']) {
                        $error_message[$i][] = 'รหัสอีเมลล์ซ้ำ';
                        $error = true;
                    }
                    if ($user_old['card'] == $user['card']) {
                        $error_message[$i][] = 'รหัสบัตรประชาชนซ้ำ';
                        $error = true;
                    }
                }
                if (!$error) {
                    {
                        $users_old[] = $user;
                    }
                }
                ++$i;
            }

            if (!$error) {
                $error = false;
                $i = 1;
                foreach ($data as $user) {
                    if(empty($user['name'])){
                        break;
                    }
                    $validator = Validator::make($user, [
                        'email' => 'required|unique:users|email',
                        'name' => 'required',
                        'card' => 'required:number:digits_between:13,13',
                        'std_id' => 'required:number:digits_between:13,13',
                    ]);
                    if ($validator->fails()) {
                        $error_message[$i] = $validator->messages()->all();
                        $error = true;
                    }
                    $i++;
                }

            } else {
                session()->flash('error_import', $error_message);
            }

            if (!$error) {
                foreach ($data as $user) {
                    if(empty($user['name'])){
                        break;
                    }
                    $room = Room::find($request->room_id);
                    $user = User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'card' => $user['card'],
                        'password' => Hash::make($user['card']),
                        'std_id' => $user['std_id'],
                        'department_id'=>$room->departments->id,
                        'campus_id'=>$room->departments->faculties->campuses->id,
                        'faculty_id'=>$room->departments->faculties->id,
                        'room_id' => $request->room_id
                    ]);
                    $user->attachRole('user');

                }
                session()->flash('success', 'Import User success.');
                return redirect()->route('user.index');
            } else {
                session()->flash('error_import', $error_message);
            }

        } else {
            session()->flash('errors', $validator1->getMessageBag());
        }

        return redirect()->route('user.import');
    }
}
