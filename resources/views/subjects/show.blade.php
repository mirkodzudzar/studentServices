@extends('layouts.app')

@section('content')
    <a href="/students">Go Back</a>
    <h1>{{$subject->name}}</h1>
    <ol>
      <li>ESPB: <b>{{$subject->espb}}</b></li>
      <li>Type: <b>{{$subject->type}}</b></li>
      <li>Professor: <b>{{$subject->professor}}</b></li>
    </ol>
    <a href="/subjects/{{$subject->id}}/edit">Edit subject</a>
    {!!Form::open(['action' => ['SubjectsController@destroy', $subject->id], 'method' => 'DELETE'])!!}
      {{Form::submit('Delete subject')}}
    {!!Form::close()!!}
@endsection
