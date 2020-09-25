<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuteDate extends Model
{
    protected $dates = ['mute_date'];

    protected $fillable = ['mute_date'];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}
