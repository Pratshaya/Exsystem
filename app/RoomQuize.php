<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomQuize extends Model
{
    protected $fillable = ['quiz_id', 'room_id'];
    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
}
