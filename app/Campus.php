<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = ['name'];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
