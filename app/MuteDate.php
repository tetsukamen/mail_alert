<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuteDate extends Model
{
    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}
