<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = ['quiz_id','name'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
