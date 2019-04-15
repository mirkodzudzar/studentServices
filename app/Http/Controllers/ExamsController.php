<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Subject;
use App\StudentSubject;

class ExamsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('revalidate');
    $this->middleware('auth');
  }

  public function show($id)
  {
    $student = Student::findOrFail($id);//student()
    $student_subject = StudentSubject::where('student_id', $id)->first();
    return view('exams.show')->with('student', $student)->with('student_subject', $student_subject);
  }

  public function reportExam(Request $request, $id)
  {
    $subject_id = $request->exam_id;
    $student_subject = StudentSubject::where('student_id', $id)->where('subject_id', $subject_id)->first();
    $student_subject->reported_exam = StudentSubject::EXAM_YES;
    $student_subject->save();

   return redirect()->route('students.show', [$id])->with('success', 'Exam reported!');
  }

  public function storePoints(Request $request, $id)
  {
    $this->validate($request, [
      'points' => 'integer|min:0|max:100'
    ]);

    $subject_id = $request->exam_id;
    $student_subject = StudentSubject::where('student_id', $id)->where('subject_id', $subject_id)->first();
    $student_subject->points = $request->input('points');

    if($request->input('points') >= 91)
    {
      $student_subject->mark = 10;
    }
    elseif($request->input('points') >= 81)
    {
      $student_subject->mark = 9;
    }
    elseif($request->input('points') >= 71)
    {
      $student_subject->mark = 8;
    }
    elseif($request->input('points') >= 61)
    {
      $student_subject->mark = 7;
    }
    elseif($request->input('points') >= 51)
    {
      $student_subject->mark = 6;
    }
    else
    {
      $student_subject->mark = 5;
    }

    $student_subject->save();

    return redirect()->back()->with('success', 'Mark edited!');
  }
}
