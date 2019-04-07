@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @if(!Auth::guest())
        @if(Auth::user()->email == 'admin@gmail.com')
          <a href="/students/{{$student->id}}">Go Back</a>
        @endif
      @endif
      @include('inc.student')
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h2>All your subjects</h2>
      @if(count($subjects) > 0)
      <table class="table">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>ESPB</th>
          <th>Type</th>
          <th>Professor</th>
          <th>Exem</th>
        </tr>
        @foreach($subjects as $subject)
          <tr>
            <td>
              {{$subject->id}}
            </td>
            <th>{{$subject->name}}</th>
            <td>{{$subject->espb}}</td>
            <td>{{$subject->type}}</td>
            <td>{{$subject->professor}}</td>
            <td>
              {!!Form::open(['action' => ['ExamsController@update', $student->id], 'method' => 'POST'])!!}
                {{Form::hidden('subject_id', $subject->id)}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Report exam')}}
              {!!Form::close()!!}
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
