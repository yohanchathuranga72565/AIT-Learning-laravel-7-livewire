<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address', 'dob', 'phone_number' , 'gender'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
