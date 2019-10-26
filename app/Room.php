<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    protected $fillable = ['name', 'detail','department_id'];

    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function room_quizzes()
    {
        return $this->hasMany(RoomQuiz::class);
    }

    public function room_questionnaires()
    {
        return $this->hasMany(RoomQuestionnaire::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);

    }

    public function result_questionnaires()
    {
        return $this->hasMany(ResultQuestionnaire::class);
    }

    public function result_quizzes()
    {
        return $this->hasMany(Result::class);
    }
}
