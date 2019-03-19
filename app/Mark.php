<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function subject()
    {
       return $this->belongsTo('App\Subject');
    }

    public function student()
    {
      return $this->hasMany('App\Student');
    }
}
