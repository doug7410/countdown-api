<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function images() {
        return $this->hasMany(Image::class);
    }
}