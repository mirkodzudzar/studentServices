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
      return $this->belongsToMany('App\Student', 'student_subject', 'student_id', 'subject_id');
    }
}
