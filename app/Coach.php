<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ["name"];
    
    public function session()
    {
        return $this->belongsToMany('App\Session', 'session_coach', 'coach_id', 'session_id');
    }
}
