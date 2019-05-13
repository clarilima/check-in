<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $guarded = [];

    public function presences()
    {
        return $this->belongsToMany(Meeting::class, 'presences', 'participant_id', 'meeting_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
