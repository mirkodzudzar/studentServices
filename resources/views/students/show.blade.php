@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      @if(!Auth::guest())
        @if(Auth::user()->email == 'admin@gmail.com')
          <a href="/exams/{{$student->id}}">Edit reporting</a>
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
          @if($subject->pivot->reported_exam === 'yes')
            <tr>
              <td>{{$subject->id}}</td>
              <th>{{$subject->name}}</th>
              <td>{{$subject->espb}}</td>
              <td>{{$subject->type}}</td>
              <td>{{$subject->professor}}</td>
              <td>
                @if(!Auth::guest())
                  @if(Auth::user()->email == 'admin@gmail.com')
                      {!!Form::open(['action' => ['ExamsController@storeMark', $student->id], 'method' => 'POST'])!!}
                        {{Form::text('mark', $subject->pivot->mark)}}
                        {{Form::hidden('exam_id', $subject->id)}}
                        {{Form::submit('Enter')}}
                      {!!Form::close()!!}
                  @else
                    @if($subject->pivot->mark !== 0)
                      {{$subject->pivot->mark}}
                    @endif
                  @endif
                @endif
              </td>
              <td>
                <p>Reported</p>
              </td>
          @endif
        @endforeach
        </tr>
      </table>
      @else
          <p>No subjects found</p>
      @endif
    </div>
  </div>
@endsection
