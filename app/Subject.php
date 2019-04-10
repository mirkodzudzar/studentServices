<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    const DEFAULT_TYPE = 0;

    protected $fillable = [
      'name', 'espb', 'type', 'professor'
    ];

    public function students()
    {
      return $this->belongsToMany('App\Student')
      ->withPivot('mark', 'mark')
    	->withTimestamps();
    }
}
