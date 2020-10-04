<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
}
