<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryQuestionnaire extends Model
{
    protected $fillable = ['name'];

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
