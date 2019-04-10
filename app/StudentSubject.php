<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    const EXAM_YES = 'yes';
    const EXAM_NO = 'no';

    protected $table = 'student_subject';
}
