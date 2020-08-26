<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function demands()
    {
        return $this->hasMany('App\Demands');
    }

    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->first();
    }
    public function isTeacher()
    {
        return $this->roles()->where('name', 'teacher')->first();
    }
    public function socialAccounts()
    {
        return $this->hasMany('App\SocialAccount');
    }
}
