<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    protected $fillable = ['name', 'detail', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function matching_options()
    {
        return $this->hasMany(MatchingOption::class);
    }

    public function rooms_quizzes()
    {
        return $this->hasMany(RoomQuize::class);
    }

    public function room_quizzes()
    {
        return $this->hasMany(RoomQuiz::class);
    }

    public function hasRoom($room)
    {
        $check = $this->room_quizzes()->where('room_id', $room->id)->count();

        if ($check > 0) {
            return true;
        }
        return false;
    }

    public function hasTest()
    {
        $has = Result::where('user_id', Auth::id())->where('quiz_id', $this->id)->count();
        if ($has > 0)
            return true;
        return false;
    }

    //For User
    public function roomResult()
    {
        $result = Result::where('user_id', Auth::id())
            ->where('quiz_id', $this->id)
            ->where('room_id', Auth::user()->room_id)
            ->first();
        return $result;
    }

    //For Admin
    public function room_result($room)
    {
        $result = ResultQuestionnaire::where('quiz_id', $this->id)
            ->where('room_id', $room)
            ->first();
        return $result;
    }
}
