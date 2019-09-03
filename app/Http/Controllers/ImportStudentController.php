<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Room;
use Illuminate\Http\Request;

class ImportStudentController extends Controller
{
    public function import()
    {
        $rooms = Room::all();
        return view('users.import')->with('rooms', $rooms);
    }

    public function import_file()
    {
        //Check

        Excel::import(new UsersImport(), request()->file('file'));

    }
}
