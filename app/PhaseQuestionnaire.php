<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhaseQuestionnaire extends Model
{
    protected $fillable = ['name', 'detail', 'questionnaire_id', 'public'];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function question_phase_questionnaires()
    {
        return $this->hasMany(QuestionPhaseQuestionnaire::class);
    }

    public function option_phase_questionnaires()
    {
        return $this->hasMany(OptionPhaseQuestionnaire::class);
    }

    public function measurements_phase_questionnaire()
    {
        return $this->hasMany(MeasurementPhaseQuestionnaire::class);
    }

    public function count_public()
    {
        return $this->where('public', true)->count();
    }
}
