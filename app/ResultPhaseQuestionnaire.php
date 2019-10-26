<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultPhaseQuestionnaire extends Model
{
    protected $fillable = ['result_questionnaire_id', 'phase_questionnaire_id', 'score'];

    public function phase_questionnaire()
    {
        return $this->belongsTo(PhaseQuestionnaire::class);
    }

    public function result_questionnaire()
    {
        return $this->belongsTo(ResultQuestionnaire::class);
    }

    public function result_detail_questionnaires()
    {
        return $this->hasMany(ResultDetailQuestionnaire::class);
    }

    public function result_measurement()
    {
        $result = '';
        $score = $this->score;
        $measurements = $this->phase_questionnaire->measurements_phase_questionnaire;
        //dd($measurements);
        foreach ($measurements as $measurement) {
            if ($measurement->score_min <= $score && $score <= $measurement->score_max)
                if($key==0){
                    $result = $measurement->result ;
                }else{
                    $result =$result .' , '. $measurement->result ;
                }
        }
        if(empty($result))
            return 'ไม่ตรงเกณฑ์';
        return $result;
    }

}
