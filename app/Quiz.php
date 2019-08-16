<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name', 'detail', 'category_id', 'type'];

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

    public function getTypeQuizAttribute()
    {
        if ($this->type === 'M')
            return "Match";
        if ($this->type === 'C')
            return "Choice";
        return "None";
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
}
