<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = ["purchase_id","attend","attendance_date","attendance_time"];
}
