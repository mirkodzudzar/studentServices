<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Department;

class DepartmentsController extends Controller
{
  public function create()
  {
      return view('departments.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|min:2|max:255',
    ]);

    $department = new Department;
    $department->name = $request->input('name');
    $department->save();

    return redirect('/students')->with('success', 'Department created!');
  }

  public function show($id)
  {
      $department = Department::findOrFail($id);
      $students = Student::where('department_id', $id)->get();
      $subjects = Subject::all();

      return view('departments.show')->with('students', $students)->with('subjects', $subjects)->with('department', $department);
  }

  public function edit($id)
  {
    $department = Department::findOrFail($id);

    return view('departments.edit')->with('department', $department);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required|string|min:2|max:255'
    ]);

    $department = Department::findOrFail($id);
    $department->name = $request->input('name');
    $department->save();

    return redirect('/students')->with('success', 'Department updated!');
  }

  public function destroy($id)
  {
    $department = Department::findOrFail($id);
    $department->delete();

    return redirect('students')->with('success', 'Department deleted');
  }
}
