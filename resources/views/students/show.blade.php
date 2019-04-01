@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
      @if(Auth::user()->email == 'admin@gmail.com')
        <a href="/students">Go Back</a>
      @endif
    @endif
    <h1>{{$student->last_name}} {{$student->first_name}}</h1>
    <ol>
      <li>First name: <b>{{$student->first_name}}</b></li>
      <li>Last name: <b>{{$student->last_name}}</b></li>
      <li>Parent name: <b>{{$student->parent_name}}</b></li>
      <li>Gender: <b>{{$student->gender}}</b></li>
      <li>Date of birth: <b>{{$student->date_of_birth}}</b></li>
      <li>Place of birth: <b>{{$student->place_of_birth}}</b></li>
      <li>Personal identification number: <b>{{$student->personal_id_number}}</b></li>
      <li>Email: <b>{{$student->email}}</b></li>
      <li>Phone number: <b>{{$student->phone_number}}</b></li>
      </ol>
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
      <ol>
          @foreach($subjects as $subject)
            <li>{{$subject->name}}</li>
          @endforeach
      </ol>
    @else
        <p>No subjects found</p>
    @endif
@endsection
