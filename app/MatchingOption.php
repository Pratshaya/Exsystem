<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchingOption extends Model
{
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
