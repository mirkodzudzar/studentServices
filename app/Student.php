<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   // protect from mass assignment vulnerabilities
   protected $fillable = [
     'first_name', 'last_name', 'parent_name', 'gender', 'date_of_birth', 'place_of_birth', 'personal_id_number', 'email', 'phone_number', 'password'
   ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];
}
