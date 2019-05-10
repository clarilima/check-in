<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    protected $guarded = [];

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}
