<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupOptionQuestionnaire extends Model
{
    protected $fillable = ['name', 'option_questionnaire_id' ,'score', 'group_questionnaire_id'];
    
    public function group_questionnaire()
    {
            return $this->belongsTo(GroupQuestionnaire::class);
    }
    public function option_questionnaire(){
        return $this->belongsTo(OptionQuestionnaire::class);

    }
}
