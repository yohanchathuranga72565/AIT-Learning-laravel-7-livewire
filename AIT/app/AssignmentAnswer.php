<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    protected $guarded = [];

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
