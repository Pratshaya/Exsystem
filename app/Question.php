<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name','objective_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function objectives()
    {
        return $this->belongsTo(Objective::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function matching_scores()
    {
        return $this->hasMany(MatchingScore::class);
    }

}
