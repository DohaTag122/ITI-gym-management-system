<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ["name", "number", "price","gym_id","start_at", "finish_at"];

    public function packages()
    {
        return $this->belongsToMany('App\Package', 'session_package', 'session_id', 'package_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'purchases', 'session_id', 'member_id');
    }

}
