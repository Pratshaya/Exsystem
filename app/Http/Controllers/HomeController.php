<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {if(Auth::user()->hasRole(['administrator','superadministrator','adminfaculty','admindepartment','adminteacher'])) {
        return view('dashboard');
    }else{
        return redirect()->route('student.room');
    }

    }
}
