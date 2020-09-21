<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];
    
    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }

    public function student()
    {
        return $this->belongsToMany('App\Student','student_subject');
    }
}
