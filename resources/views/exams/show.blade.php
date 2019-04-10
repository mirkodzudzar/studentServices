@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      @if(!Auth::guest())
        @if(Auth::user()->email == 'admin@gmail.com')
          <a href="/students/{{$student->id}}">Go Back</a>
        @endif
      @endif
      @include('inc.student')
    </div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
      <h2>All your subjects</h2>
      <table class="table">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>ESPB</th>
          <th>Type</th>
          <th>Professor</th>
          @if(!Auth::guest())
            @if(Auth::user()->email == 'admin@gmail.com')
              <th>Mark</th>
            @endif
          @endif
          <th>Exem</th>
        </tr>
        @foreach($student->subjects as $subject)
          <tr>
            <td>{{$subject->id}}</td>
            <th>{{$subject->name}}</th>
            <td>{{$subject->espb}}</td>
            <td>{{$subject->type}}</td>
            <td>{{$subject->professor}}</td>
            @if(!Auth::guest())
              @if(Auth::user()->email == 'admin@gmail.com')
                <td>
                  {!!Form::open(['action' => ['ExamsController@storeMark', $student->id], 'method' => 'POST'])!!}
                    {{Form::text('mark', $subject->pivot->mark)}}
                    {{Form::hidden('exam_id', $subject->id)}}
                    {{Form::submit('Enter')}}
                  {!!Form::close()!!}
                </td>
              @endif
            @endif
            <td>
              {!!Form::open(['action' => ['ExamsController@reportExam', $student->id], 'method' => 'POST'])!!}
                {{Form::hidden('exam_id', $subject->id)}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Report exam')}}
              {!!Form::close()!!}
            </td>
        @endforeach
        </tr>
      </table>
    </div>
  </div>
@endsection
