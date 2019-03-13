<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectsController extends Controller
{
    public function show($id)
    {
      $subject = Subject::find($id);
      return view('students.show')->with('subject', $subject);
    }
}
