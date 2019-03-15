<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Subject;
use DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('last_name', 'asc')->paginate(10);
        return view('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
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
          'first_name' => 'required',
          'last_name' => 'required',
          'parent_name' => 'required',
          'gender' => 'required',
          'date_of_birth' => 'required',
          'place_of_birth' => 'required',
          'personal_id_number' => 'required',
          'email' => 'required',
          'phone_number' => 'required'
        ]);

        $student = new Student;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->parent_name = $request->input('parent_name');
        $student->gender = $request->input('gender');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->place_of_birth = $request->input('place_of_birth');
        $student->personal_id_number = $request->input('personal_id_number');
        $student->email = $request->input('email');
        $student->phone_number = $request->input('phone_number');
        $student->save();

        return redirect('/students')->with('success', 'Student created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show')->with('student', $student);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit')->with('student', $student);
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
          'first_name' => 'required',
          'last_name' => 'required',
          'parent_name' => 'required',
          'gender' => 'required',
          'date_of_birth' => 'required',
          'place_of_birth' => 'required',
          'personal_id_number' => 'required',
          'email' => 'required',
          'phone_number' => 'required'
        ]);

        $student = Student::find($id);
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->parent_name = $request->input('parent_name');
        $student->gender = $request->input('gender');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->place_of_birth = $request->input('place_of_birth');
        $student->personal_id_number = $request->input('personal_id_number');
        $student->email = $request->input('email');
        $student->phone_number = $request->input('phone_number');
        $student->save();

        return redirect('/students')->with('success', 'Student updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted!');
    }
}
