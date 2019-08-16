<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    protected $fillable = ['name', 'detail'];

    public function room_quizzes()
    {
        return $this->hasMany(RoomQuiz::class);
    }

    public function room_questionnaires()
    {
        return $this->hasMany(RoomQuestionnaire::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

}
