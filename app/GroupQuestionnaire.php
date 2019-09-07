<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupQuestionnaire extends Model
{
    protected $fillable = ['name', 'questionnaire_id'];

    public function group_option_questionnaires()
    {
            return $this->hasMany(GroupOptionQuestionnaire::class);
    }
}
