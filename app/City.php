<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = ["name"];

    public function City_manager()
    {
        return $this->belongsToMany('App\User', 'user_city', 'user_id', 'city_id');
    }
}


