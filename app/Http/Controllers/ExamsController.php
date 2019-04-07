<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $subjects = Subject::all();
    return view('exams.show')->with('student', $student)->with('subjects', $subjects);
  }

  public function update(Request $request, $id)
  {
     $student_subject = new StudentSubject;
     $student_subject->student_id = $id;
     $student_subject->subject_id = $request->subject_id;
     $student_subject->mark = Student::DEFAULT_TYPE;
     $student_subject->reported_exam = Student::EXAM_TYPE;
     $student_subject->save();

    return redirect()->route('students.show', [$id])->with('success', 'Exam reported!');
  }
}
