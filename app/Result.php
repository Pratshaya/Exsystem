<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $fillable = ['quiz_id', 'user_id', 'score', 'room_id'];

    public function result_details()
    {
        return $this->hasMany(ResultDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function result_measurement()
    {
        $result = 'ไม่ตรงผลประเมิน';
        $score = $this->score;
        $measurements = $this->quiz->measurement_quizzes;
        if (empty($measurement))
            return $result;
        foreach ($measurements as $measurement) {
            if ($measurement->score_min <= $score && $score <= $measurement->score_max)
                $result .= $measurement->result . ',';
        }
        return $result;
    }
}
