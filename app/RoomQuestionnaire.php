<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomQuestionnaire extends Model
{
    protected $fillable = ['questionnaire_id', 'room_id'];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }


}
