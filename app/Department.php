<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name','faculty_id'];

    public function rooms(){
        return $this->hasMany(Room::class);
    }
    public function faculties(){
        return $this->belongsTo(Faculty::class,'faculty_id');
    }
    public function quizzes(){
        return $this->hasMany(Quiz::class);
    }

    public function questionnaires(){
        return $this->hasMany(Questionnaire::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}