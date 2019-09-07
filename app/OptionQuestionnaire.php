<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionQuestionnaire extends Model
{
    protected $fillable = ['option', 'questionnaire_id'];

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
}
