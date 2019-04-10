@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
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
            {{Form::hidden('student_email', $student->email)}}
            {{Form::submit('Delete student')}}
          {!!Form::close()!!}
        @endif
      @endif
    </div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
      @if(!Auth::guest())
        @if(Auth::user()->email == 'admin@gmail.com')
          <a href="/exams/{{$student->id}}">Edit marks</a>
        @endif
      @endif
      <h2>Reported exams</h2>
      @if(count($subjects) > 0)
      <table class="table">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>ESPB</th>
          <th>Type</th>
          <th>Professor</th>
          <th>Mark</th>
          <th>Exem</th>
        </tr>
        @foreach($student->subjects as $subject)
            <tr>
              <td>{{$subject->id}}</td>
              <th>{{$subject->name}}</th>
              <td>{{$subject->espb}}</td>
              <td>{{$subject->type}}</td>
              <td>{{$subject->professor}}</td>
              <td>
                @if($subject->pivot->mark !== 0)
                  {{$subject->pivot->mark}}
                @endif
              </td>
              <td>
                @if($subject->pivot->reported_exam == 'yes')
                  <p>Repotred</p>
                @endif
              </td>
        @endforeach
        </tr>
      </table>
      @else
          <p>No subjects found</p>
      @endif
    </div>
  </div>
@endsection
