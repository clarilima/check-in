<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $guarded = [];

    public function groups()
    {
        return $this->hasMany('App\Group');
    }
}
