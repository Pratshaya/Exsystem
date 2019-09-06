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
        return $this->belongsTo(Faculty::class);
    }
}