<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Auth;

class Student extends Model
{
  use Notifiable;

  const DEFAULT_TYPE = 0;
  const STUDENT_MALE = 'male';
  const STUDENT_FEMALE = 'female';

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

  public function user()
  {
      return $this->belongsTo('App\User', 'email');
  }

  public function department()
  {
      return $this->belongsTo('App\Department');
  }

  public function subjects()
  {
      return $this->belongsToMany('App\Subject')
      ->withPivot('points', 'points')
      ->withPivot('mark', 'mark')
      ->withPivot('reported_exam', 'reported_exam')
    	->withTimestamps();
  }

  public static function allStudents()
  {
    return static::all();
  }
}
