@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Departments</h1>
      @if(count($departments) > 0)
        @foreach($departments as $department)
          {{$department->id}}. <a href="/departments/{{$department->id}}">{{$department->name}}</a><br>
        @endforeach
      @else
        <p>No departments found</p>
      @endif
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
