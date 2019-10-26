<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','department_id'];

    public function departments(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
