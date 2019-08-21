<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomQuiz extends Model
{
    protected $fillable = ['quiz_id', 'room_id'];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
}
