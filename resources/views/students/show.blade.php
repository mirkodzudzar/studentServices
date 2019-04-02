@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
      @if(Auth::user()->email == 'admin@gmail.com')
        <a href="/students">Go Back</a>
      @endif
    @endif
    @include('inc.student')
    @if(!Auth::guest())
      @if(Auth::user()->email == 'admin@gmail.com')
        <a href="/students/{{$student->id}}/edit">Edit student</a>
        {!!Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'DELETE'])!!}
          {{Form::submit('Delete student')}}
        {!!Form::close()!!}
      @endif
    @endif
    <hr>
    <h2>Subjects</h2>
    @if(count($subjects) > 0)
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>ESPB</th>
        <th>Type</th>
        <th>Professor</th>
        <th>Mark</th>
      </tr>
      @foreach($student->subjects as $subject)
        <tr>
          <td>{{$subject->id}}</td>
          <td>{{$subject->name}}</td>
          <td>{{$subject->espb}}</td>
          <td>{{$subject->type}}</td>
          <td>{{$subject->professor}}</td>
          <td>{{$subject->pivot->mark}}</td>
          <td></td>
      @endforeach
      </tr>
    </table>
    @else
        <p>No subjects found</p>
    @endif
@endsection
