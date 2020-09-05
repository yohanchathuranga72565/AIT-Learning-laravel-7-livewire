<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_ extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address', 'age', 'phone_number' ,'occupation' , 'gender'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
