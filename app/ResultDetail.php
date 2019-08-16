<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    protected $fillable = ['result_id', 'question_id', 'option_id'];
    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function option(){
        return $this->belongsTo(Option::class);
    }
}
