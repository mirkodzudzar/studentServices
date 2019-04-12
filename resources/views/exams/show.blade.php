@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      @if(!Auth::guest())
        @if(Auth::user()->email == 'admin@gmail.com')
          <a href="/students/{{$student->id}}">Go Back</a>
        @endif
      @endif
      @include('inc.student')
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h2>All your subjects</h2>
      <table class="table">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>ESPB</th>
          <th>Type</th>
          <th>Professor</th>
          <th>Exem</th>
        </tr>
        @foreach($student->subjects as $subject)
          @if($subject->pivot->reported_exam === 'no')
            <tr>
              <td>{{$subject->id}}</td>
              <th>{{$subject->name}}</th>
              <td>{{$subject->espb}}</td>
              <td>{{$subject->type}}</td>
              <td>{{$subject->professor}}</td>
              <td>
                {!!Form::open(['action' => ['ExamsController@reportExam', $student->id], 'method' => 'POST'])!!}
                  {{Form::hidden('exam_id', $subject->id)}}
                  {{Form::hidden('_method', 'PUT')}}
                  {{Form::submit('Report exam')}}
                {!!Form::close()!!}
              </td>
          @endif
        @endforeach
        </tr>
      </table>
    </div>
  </div>
@endsection
