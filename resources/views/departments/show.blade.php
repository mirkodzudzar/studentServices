@extends('layouts.app')

@section('content')
  <div>
    <a href="/departments/{{$department->id}}/edit">Edit department</a>
    {!!Form::open(['action' => ['DepartmentsController@destroy', $department->id], 'method' => 'DELETE'])!!}
      {{Form::submit('Delete department')}}
    {!!Form::close()!!}
    @if(count($students) > 0)
    <h1>{{$department->name}}</h1>
    <h4>Students</h4>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Last name</th>
        <th>Parent name</th>
        <th>First name</th>
        <th>Department</th>
      </tr>
      <tr>
        @foreach($students as $student)
          @if($student->first_name !== 'admin')
            <td>{{$student->id}}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->parent_name }}</td>
            <td>{{ $student->first_name }}</td>
            <td>{{ $student->department->name }}</td>
            <td><a href="/students/{{$student->id}}">Show</a></td>
          @endif
      </tr>
        @endforeach
    </table>
    @else
      <p>No students found.</p>
    @endif
  </div>
@endsection
