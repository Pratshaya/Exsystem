<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $fillable = ['quiz_id', 'user_id', 'score'];

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
}
