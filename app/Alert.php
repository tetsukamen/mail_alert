<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public function mute_dates(){
        return $this->belongsToMany('App\MuteDate');
    }
}
