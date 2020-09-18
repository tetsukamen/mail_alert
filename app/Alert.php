<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $dates = ['time','first_alert_timing','second_alert_timing'];

    public function mute_dates()
    {
        return $this->hasMany(MuteDate::class);
    }

}
