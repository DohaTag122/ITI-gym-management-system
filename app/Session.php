<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Session extends Model
{
    protected $fillable = ["name", "day","start_at","finish_at","price","session_amount","gym_id"];

    public function packages()
    {
        return $this->belongsToMany('App\Package', 'session_package', 'session_id', 'package_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'purchases', 'session_id', 'member_id');
    }


    public function coaches()
    {
        return $this->belongsToMany('App\Coach', 'coach_session', 'session_id', 'coach_id')->withTimestamps();
    }
    public function gym()
    {
        return $this->belongsTo('App\Gym')->with('city');

    }
    /**
     * An accessor on price
     */
    public function getPriceAttribute($cents){
        $dollars = $cents / 100;
        return $dollars;
    }
    /**
     * Mutator on price
     */
    public function setPriceAttribute($dollars){
        $this->attributes['price'] = $dollars * 100 ;
    }

}
