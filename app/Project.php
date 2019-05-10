<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    public function groups()
    {
        return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
