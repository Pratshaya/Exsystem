<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Questionnaire;
use App\Quiz;
use App\Room;
use App\RoomQuestionnaire;
use App\RoomQuiz;
use App\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $rooms = Room::paginate(10);
        return view('room.index')->with('rooms', $rooms)->with('departments',$departments);
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
    public function store(CreateRoomRequest $request)
    {
        Room::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'department_id' => $request->department_id
        ]);

        session()->flash('success', 'Room created successfully');

        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('room.edit')->with('room', $room);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->update([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        session()->flash('success', 'Room update successfully');

        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if ($room->users->isEmpty()) {
           $room->delete();
            session()->flash('success', 'ลบห้องสอบแล้ว');
        }else{
            session()->flash('error', 'ไม่สามารถลบห้องสอบได้ เนื่องจากมีนักเรียนอยู่ในห้องนี้.');
        }
        return redirect()->route('room.index');
    }

    public function quiz_questionnaire()
    {
        $rooms = Room::paginate(10);
        return view('room.quiz_questionnaire')->with('rooms', $rooms);
    }

    public function show_questionnaire_quiz(Room $room)
    {
        $quizzes = Quiz::all();
        $questionnaires = Questionnaire::all();
        return view('room.quiz_questionnaire_show')
            ->with('quizzes', $quizzes)
            ->with('questionnaires', $questionnaires)
            ->with('room', $room);
    }

    public function store_questionnaire_quiz(Request $request, Room $room)
    {
        if (!empty($request->questionnaires)) {
            foreach ($request->questionnaires as $questionnaire) {
                RoomQuestionnaire::create([
                    'room_id' => $room->id,
                    'questionnaire_id' => $questionnaire
                ]);
            }
        }

        if (!empty($request->quizzes)) {
            foreach ($request->quizzes as $quiz) {
                RoomQuiz::create([
                    'room_id' => $room->id,
                    'quiz_id' => $quiz
                ]);
            }
        }
        session()->flash('success', 'Room created successfully');

        return redirect()->route('quiz_questionnaire.show', $room->id);
    }

    public function student(Room $room)
    {
        return view('room.students')->with('users', $room->users);
    }
}
