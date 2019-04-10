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

  public function storeMark(Request $request, $id)
  {
    $this->validate($request, [
      'mark' => 'integer|min:5|max:10'
    ]);

    $subject_id = $request->exam_id;
    $student_subject = StudentSubject::where('student_id', $id)->where('subject_id', $subject_id)->first();
    $student_subject->mark = $request->input('mark');;
    $student_subject->save();

    return redirect()->back()->with('success', 'Mark edited!');
  }
}
