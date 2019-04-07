@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a href="/students/create">Create new student</a><br><br>
      @if(count($students) > 1)
      <table class="table">
        <tr>
          <th>Last name</th>
          <th>Parent name</th>
          <th>First name</th>
          <th>ID</th>
          <th>Subjects</th>
        </tr>
        <tr>
          @foreach($students as $student)
            @if($student->first_name !== 'admin')
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->parent_name }}</td>
            <td>{{ $student->first_name }}</td>
            <td>{{$student->id}}</td>
            <td><a href="/students/{{$student->id}}">Show</a></td>
            @endif
          </tr>
          @endforeach
        </table>
      @else
          <p>No students found</p>
      @endif
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a href="subjects/create">Create new subject for all students</a>
      <h2>Subjects</h2>
      @if(count($subjects) > 0)
        @foreach ($subjects as $subject)
        <ol>
          <b><a href="/subjects/{{$subject->id}}">{{$subject->name}}</a></b>
          <li>ESPB: {{$subject->espb}}</li>
          <li>Type: {{$subject->type}}</li>
          <li>Professor: {{$subject->professor}}</li>
        </ol>
        @endforeach
      @else
        <p>No subjects found</p>
      @endif
    </div>
  </div>
@endsection
