<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = ["city_manager_id", "city_id", "name","image"];
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }    
}
