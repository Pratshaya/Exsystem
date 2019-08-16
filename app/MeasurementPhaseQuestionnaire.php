<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementPhaseQuestionnaire extends Model
{
    protected $fillable = ['result', 'score_min', 'score_max', 'phase_questionnaire_id'];

    public function phase_questionnaire()
    {
        return $this->belongsTo(PhaseQuestionnaire::class);
    }
}
