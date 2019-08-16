<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementQuestionnaire extends Model
{
    protected $fillable = ['result', 'score_min', 'score_max', 'questionnaire_id'];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
