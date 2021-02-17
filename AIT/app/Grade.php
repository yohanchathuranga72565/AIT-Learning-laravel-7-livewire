<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = [];
    
    public function teacher()
    {
        return $this->belongsToMany('App\Teacher','teacher_grade');
    }

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function resource()
    {
        return $this->hasMany('App\Resource');
    }

    public function assignment()
    {
        return $this->hasMany('App\Assignment');
    }
}
