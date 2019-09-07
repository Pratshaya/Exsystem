<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPhaseQuestionnaire extends Model
{
    protected $fillable = ['name', 'phase_questionnaire_id','group_questionnaire_id'];

    public function phase_questionnaire()
    {
        return $this->belongsTo(PhaseQuestionnaire::class);
    }
    
    public function group_questionnaire()
    {
        return $this->belongsTo(GroupQuestionnaire::class);
    }


}
