<?php

namespace App\Http\Controllers;

use App\Category;
use App\Questionnaire;
use App\Quiz;
use App\Room;
use App\RoomQuestionnaire;
use App\RoomQuiz;
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
        $rooms = Room::paginate(10);
        return view('room.index')->with('rooms', $rooms);
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
        Room::create([
            'name' => $request->name,
            'detail' => $request->detail
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
        //
    }

    public function quiz_questionnaire()
    {
        $rooms = Room::paginate(10);
        return view('room.quiz_questionnaire')->with('rooms', $rooms);
    }

    public function show_questionnaire_quiz(Room $room)
    {
        $quizzes = Quiz::all();
        $questionnaires = Questionnaire::where('');
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
