<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ["name", "number", "price", "start_at", "finish_at"];
    public function packages()
    {
        return $this->belongsToMany('App\Package', 'session_package', 'session_id', 'package_id');
    }
}
