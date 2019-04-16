<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Student;
use App\Subject;
use App\Department;
use App\StudentSubject;

use DB;

class StudentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //revalidate stops you going back if you are logged out
      //auth stops unlloged users to do enything
      //if you are not admin, you can just visit you profile
      $this->middleware('revalidate');
      $this->middleware('auth');
      $this->middleware('is_admin', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //showing all students and all subjects(evry student has every subject!!!)
        $students = Student::allStudents()->sortBy('department_id');
        $subjects = Subject::all();
        $departments = Department::all();
        return view('students.index')->with('students', $students)->with('subjects', $subjects)->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //showing create form
        $male = Student::STUDENT_MALE;
        $female = Student::STUDENT_FEMALE;
        $departments = Department::all();
        return view('students.create')->with('departments', $departments)->with('male', $male)->with('female', $female);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //WORKING
        $this->validate($request, [
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'parent_name' => 'required|string|min:2',
          'gender' => 'required',
          'date_of_birth' => 'required|string|max:11',
          'place_of_birth' => 'required|string|max:255',
          'personal_id_number' => 'required|integer|min:1|max:9999999999',
          'phone_number' => 'required|string',
          'email' => 'required|string|email|max:255|unique:students',
          'password' => 'required|string|min:6|confirmed',
        ]);
        //creating user
        $user = new User;
        $user->name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request['password']);
        $user->type = User::DEFAULT_TYPE;

        //creating student that is also new user
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
        $student->department_id = $request->department_id;

        $user->save();
        $student->save();

        $subject = Subject::all();
        $user->type = User::DEFAULT_TYPE;
        $subject->mark = Student::DEFAULT_TYPE;
        $subject->points = Student::DEFAULT_TYPE;
        $student->subjects()->attach($subject);

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
        //showing each student with abillity of edit and delete
        $student = Student::findOrFail($id);//student()
        $subjects = Subject::all();
        //$student_subject = StudentSubject::where('student_id', $id)->where('reported_exam', StudentSubject::EXAM_YES)->get();
        return view('students.show')->with('student', $student)->with('subjects', $subjects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //showing edit form for student
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
        //updateing student and user
        //WORKING
        $this->validate($request, [
          'first_name' => 'required|string|min:2|max:255',
          'last_name' => 'required|string|min:2|max:255',
          'parent_name' => 'required|string|min:2|max:255',
          'gender' => 'required',
          'date_of_birth' => 'required|string|max:11',
          'place_of_birth' => 'required|string|max:255',
          'personal_id_number' => 'required|integer|min:1|max:9999999999',
          'email' => 'required|string|email|max:255|unique:students',//students
          'phone_number' => 'required|integer'
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

        $email = $request->student_email;
        $user = User::where('email', $email)->first();
        $user->name = $request->input('first_name');
        $user->email = $request->input('email');

        $student->save();
        $user->save();

        return redirect('/students')->with('success', 'Student updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //deleting student, user and student_subject fields
        //WORKING
        $student_subject = StudentSubject::where('student_id', $id);

        $student = Student::findOrFail($id);

        $user = User::where('email', $request->student_email);

        $student_subject->delete();
        $student->delete();
        $user->delete();

        return redirect('/students')->with('success', 'Student deleted!');
    }
}
