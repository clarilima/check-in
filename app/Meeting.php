<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected $guarded = [];

    public function presences()
    {
        return $this->belongsToMany(Participant::class, 'presences');
    }

    public function groups()
    {
        return $this->hasManyThrough(Group::class, Participant::class);
    }
}
