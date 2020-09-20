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
}
