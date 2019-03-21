@extends('layouts.app')

@section('content')
  <h1>Edit Subject</h1>
    {!! Form::model($subject, ['method' => 'PATCH', 'action' => ['SubjectsController@update',$subject->id]]) !!}
      {{ csrf_field() }}
      <div>
        {{Form::label('name', 'Subject')}}
        {{Form::text('name', $subject->name, ['placeholder' => 'Subject'])}}
      </div>
      <div>
        {{Form::label('espb', 'ESPB')}}
        {{Form::text('espb', $subject->espb, ['placeholder' => 'ESPB'])}}
      </div>
      <div>
        {{Form::label('type', 'Type')}}<br>
        Compulsary {{Form::radio('type', 'Compulsary', true)}}
        Non compulsary {{Form::radio('type', 'Non compulsary')}}
      </div>
      <div>
        {{Form::label('professor', 'Professor')}}
        {{Form::text('professor', $subject->professor, ['placeholder' => 'Professor'])}}
      </div>
      <div>
        {{Form::submit('Edit Subject')}}
      </div>
    {!! Form::close() !!}
    </div>
  </form>
@endsection
