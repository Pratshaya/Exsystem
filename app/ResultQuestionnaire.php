<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultQuestionnaire extends Model
{
    protected $fillable = ['questionnaire_id', 'user_id'];

    public function result_phase_questionnaire()
    {
        return $this->hasMany(ResultPhaseQuestionnaire::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d F Y');
    }
}
