<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name','campus_id'];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function campuses(){
        return $this->belongsTo(Campus::class,'campus_id');
    }
    public function users(){
        return $this->hasMany(User::class);
    }

}
