<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementQuiz extends Model
{
    protected $fillable = ['result', 'score_min', 'score_max', 'quiz_id'];

    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }
}
