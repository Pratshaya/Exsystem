<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
}
