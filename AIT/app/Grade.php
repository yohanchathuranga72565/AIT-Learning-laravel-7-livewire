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
}
