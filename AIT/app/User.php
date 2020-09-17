<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;


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

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }

    public function parent()
    {
        return $this->hasOne('App\Parent_');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function question()
    {
        return $this->hasMany('App\Question');
    }
}
