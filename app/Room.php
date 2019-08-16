<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['quiz_id'];

    public function rooms_quizzes()
    {
        return $this->hasMany(RoomQuiz::class);
    }

}
