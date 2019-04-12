<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
      'name', 'espb', 'type', 'professor'
    ];

    public function students()
    {
      return $this->belongsToMany('App\Student')
      ->withPivot('mark', 'mark')
      ->withPivot('reported_exam', 'reported_exam')
    	->withTimestamps();
    }
}
