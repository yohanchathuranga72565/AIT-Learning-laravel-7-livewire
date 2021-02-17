<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address', 'dob', 'phone_number' ,'subject_id' , 'gender'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function grade()
    {
        return $this->belongsToMany('App\Grade','teacher_grade'); 
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function student()
    {
        return $this->belongsToMany('App\Student','student_teachers');
    }

    public function resource()
    {
        return $this->hasMany('App\Resource');
    }

    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function assignment()
    {
        return $this->hasMany('App\Assignment');
    }

    
}
