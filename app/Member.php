<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = ['name', 'email', 'password','gender','date_of_birth','profile_image'];

    public function sessions()
    {
        return $this->belongsToMany('App\Session', 'purchases', 'member_id', 'session_id');
    }
}
