@extends('layouts.app')

@section('content')
  <a href="/students/create">Create new student</a><br><br>
  @if(count($students) > 0)
  <table>
    <tr>
      <th>Last name</th>
      <th>Parent name</th>
      <th>First name</th>
      <th>ID</th>
      <th>Sucjects</th>
    </tr>
    <tr>
      @foreach($students as $student)
        <td>{{ $student->last_name }}</td>
        <td>{{ $student->parent_name }}</td>
        <td>{{ $student->first_name }}</td>
        <td>{{$student->id}}</td>
        <td><a href="/students/{{$student->id}}">Edit</td>
      </tr>
      @endforeach
    </table>
  @else
      <p>No students found</p>
  @endif
@endsection
