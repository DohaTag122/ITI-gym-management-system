<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ["name","gym_id"];
    
    public function session()
    {
        return $this->belongsToMany('App\Session', 'session_coach', 'coach_id', 'session_id');
    }

    public function Gym()
    {
        return $this->belongsTo('App\Gym');
    }
}
