<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Student;
use App\StudentSubject;
use Auth;

class SubjectsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('revalidate');
    $this->middleware('is_admin');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      // $subject = Subject::where('student_id', Auth::user()->id)->get();
      return view('subjects.create');
      // ->with('subject', $subject);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|min:2|max:255',
      'espb' => 'required|integer|min:1|max:10',
      'type' => 'required',
      'professor' => 'required|string|min:2|max:255'
    ]);

    $subject = new Subject;
    $subject->name = $request->input('name');
    $subject->espb = $request->input('espb');
    $subject->type = $request->input('type');
    $subject->professor = $request->input('professor');
    $subject->save();

    return redirect('/students')->with('success', 'Subject created!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $subjects = Subject::all();
      $subject = Subject::findOrFail($id);
      return view('subjects.show')->with('subject', $subject)->with('subjects', $subjects);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $subject = Subject::findOrFail($id);
    return view('subjects.edit')->with('subject', $subject);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required|string|min:2|max:255',
      'espb' => 'required|integer|min:1|max:10',
      'type' => 'required',
      'professor' => 'required|string|min:2|max:255'
    ]);

    $subject = Subject::findOrFail($id);
    $subject->name = $request->input('name');
    $subject->espb = $request->input('espb');
    $subject->type = $request->input('type');
    $subject->professor = $request->input('professor');
    $subject->save();

    return redirect()->route('students.show', [$user->id])->with('success', 'Subject updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $student_subject = StudentSubject::where('subject_id', $id);
    $student_subject->delete();

    $subject = Subject::findOrFail($id);
    $subject->delete();

    return redirect('students')->with('success', 'Subject deleted');
  }
}
