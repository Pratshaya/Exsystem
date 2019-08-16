<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'detail'];

    public function rooms_quizzes()
    {
        return $this->hasMany(RoomQuiz::class);
    }

}
