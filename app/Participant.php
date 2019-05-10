<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $guarded = [];

    public function presences()
    {
        return $this->belongsToMany('App\Presence');
    }
}
