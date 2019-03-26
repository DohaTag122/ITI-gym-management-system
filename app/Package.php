<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ["number_of_sessions", "name","gym_id", "package_price"];

    public function sessions()
    {
        return $this->belongsToMany('App\Session')->withTimestamps()->withPivot('session_amount');
    }

    public function gyms()
    {
        return $this->belongsTo('App\Gym','gym_id','id');
    }

    /**
     * An accessor on price
     */
    public function getPackagePriceAttribute($cents){
        $dollars = $cents / 100;
        return $dollars;
    }
    /**
     * Mutator on price
     */
    public function setPackagePriceAttribute($dollars){
        $this->attributes['package_price'] = $dollars * 100 ;
    }

}
