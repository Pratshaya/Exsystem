<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultDetailQuestionnaire extends Model
{
    protected $fillable = ['result_phase_questionnaire_id', 'question_phase_questionnaire_id', 'option_phase_questionnaire_id'];

    public function result_phase_questionnaire()
    {
        return $this->belongsTo(ResultPhaseQuestionnaire::class);
    }

    public function question_phase_questionnaire()
    {
        return $this->belongsTo(QuestionPhaseQuestionnaire::class);
    }

    public function option_phase_questionnaire()
    {
        return $this->belongsTo(OptionPhaseQuestionnaire::class);
    }
}
