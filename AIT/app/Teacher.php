<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address', 'age', 'phone_number' ,'grade' , 'gender'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
