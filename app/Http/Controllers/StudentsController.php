<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Student;
use App\Subject;
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
        $students = Student::orderBy('last_name', 'asc')->paginate(10);
        $subjects = Subject::all();
        return view('students.index')->with('students', $students)->with('subjects', $subjects);
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
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'parent_name' => 'required|string|min:2',
          'gender' => 'required',
          'date_of_birth' => 'required|string|max:11',
          'place_of_birth' => 'required|string|max:255',
          'personal_id_number' => 'required|integer|max:9999999999',
          'phone_number' => 'required|string',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);
        //creating user
        $user = new User;
        $user->name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request['password']);
        $user->type = User::DEFAULT_TYPE;
        $user->save();
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
        $marking = StudentSubject::where('student_id', $id)->get();
        return view('students.show')->with('student', $student)->with('marking', $marking);
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
          'first_name' => 'required|string|min:2|max:255',
          'last_name' => 'required|string|min:2|max:255',
          'parent_name' => 'required|string|min:2|max:255',
          'gender' => 'required',
          'date_of_birth' => 'required|string|max:11',
          'place_of_birth' => 'required|string|max:255',
          'personal_id_number' => 'required|integer|min:1000000000|max:9999999999',
          'email' => 'required|string|email|max:255|unique:users',//students
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
        $user = User::find($id);
        $user->delete();

        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted!');
    }
}
