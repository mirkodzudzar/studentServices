<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function marking()
    {
      return $this->belongsToMany('App\Marking');
    }
}
