<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionPhaseQuestionnaire extends Model
{
    protected $fillable = ['name', 'score', 'phase_questionnaire_id'];

    public function phase_questionnaires()
    {
        return $this->belongsTo(PhaseQuestionnaire::class);
    }
}
