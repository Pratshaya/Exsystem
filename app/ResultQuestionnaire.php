<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultQuestionnaire extends Model
{
    protected $fillable = ['questionnaire_id', 'user_id', 'score', 'room_id'];

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

    public function result_measurement()
    {
        if ($this->questionnaire->type == 'P')
            return '-';
        $result = '';
        $score = $this->score;
        $measurements = $this->questionnaire->measurements_questionnaire;
        foreach ($measurements as $measurement) {
            if ($measurement->score_min <= $score && $score <= $measurement->score_max)
                $result .= $measurement->result . ',';
        }

        return $result;
    }
}
