<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['name', 'detail', 'category_questionnaire_id',];

    public function category()
    {
        return $this->belongsTo(CategoryQuestionnaire::class,'category_questionnaire_id');
    }

    public function phase_questionnaires()
    {
        return $this->hasMany(PhaseQuestionnaire::class);
    }

    public function count_public()
    {
        return $this->phase_questionnaires()->where('public', true)->count();
    }

    public function question_count()
    {
        $phases = $this->phase_questionnaires()->where('public', true)->get();
        $sum = 0;
        foreach ($phases as $phase) {
            $sum += $phase->question_phase_questionnaires()->count('id');
        }
        return $sum;
    }


}
