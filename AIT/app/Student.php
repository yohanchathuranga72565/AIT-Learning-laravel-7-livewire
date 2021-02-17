<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address', 'dob', 'phone_number', 'gender','grade_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Parent_');
    }

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function subject()
    {
        return $this->belongsToMany('App\Subject','student_subject');
    }

    public function teacher()
    {
        return $this->belongsToMany('App\Teacher','student_teachers');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    public function assignmentAnswer()
    {
        return $this->hasMany('App\AssignmentAnswer');
    }

}
