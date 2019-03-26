<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Member extends Authenticatable implements JWTSubject , MustVerifyEmail
{
    //



    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','gender','date_of_birth','profile_image','active', 'activation_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



    public function sessions()
    {
        return $this->belongsToMany('App\Session', 'purchases', 'member_id', 'session_id');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'member_id','id');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance', 'member_id','id');
    }
}
