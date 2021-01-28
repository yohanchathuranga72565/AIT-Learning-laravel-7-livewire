<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function course()
    {
        return $this->hasMany('App\Course');
    }
}
