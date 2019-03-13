<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  // protect from mass assignment vulnerabilities
  protected $fillable = [
    'first_name', 'last_name', 'parent_name', 'gender', 'date_of_birth', 'place_of_birth', 'personal_id_number', 'email', 'phone_number'
  ];

  public function subject()
  {
    return $this->hasMany('App\Subject');
  }
}
