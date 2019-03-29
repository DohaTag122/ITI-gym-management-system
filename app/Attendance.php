<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //

    protected $fillable = ["member_id","session_id","attend","attendance_date","attendance_time"];


    public function session()
    {
        return $this->belongsTo('App\Session')->with('gym');
    }

    public function memeber()
    {
        return $this->belongsTo('App\Member','member_id','id');
    }


}
