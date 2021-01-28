<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function courseContent()
    {
        return $this->hasMany('App\CourseContent');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }
}
