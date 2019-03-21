<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ["number_of_sessions", "name","gym_id"];

    public function sessions()
    {
        return $this->belongsToMany('App\Session', 'session_package', 'package_id', 'session_id');
    }
}
