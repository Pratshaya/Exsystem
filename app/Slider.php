<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = ['title', 'detail', 'image', 'status_id'];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
