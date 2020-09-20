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


}
