<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $casts = [
        'second_alert_flag' => 'boolean',
    ];

    public function mute_dates(){
        return $this->belongsToMany('App\MuteDate');
    }
}
