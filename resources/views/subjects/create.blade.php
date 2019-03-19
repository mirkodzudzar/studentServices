@extends('layouts.app')

@section('content')
  <a href="/students">Go Back</a>
  <h1>Create New Subject</h1>
    {!!Form::open(['action' => 'SubjectsController@store', 'method' => 'POST'])!!}
      {{ csrf_field() }}
      <div>
        {{Form::label('name', 'Subject')}}
        {{Form::text('name', '', ['placeholder' => 'Subject'])}}
      </div>
      <div>
        {{Form::label('espb', 'ESPB')}}
        {{Form::text('espb', '', ['placeholder' => 'ESPB'])}}
      </div>
      <div>
        {{Form::label('type', 'Type')}}<br>
        Compulsary {{Form::radio('type', 'Compulsary', true)}}
        Non compulsary {{Form::radio('type', 'Non compulsary')}}
      </div>
      <div>
        {{Form::label('professor', 'Professor')}}
        {{Form::text('professor', '', ['placeholder' => 'Professor'])}}
      </div>
      <div>
        {{Form::submit('Create Subject')}}
      </div>
    {!! Form::close() !!}
    </div>
  </form>
@endsection
