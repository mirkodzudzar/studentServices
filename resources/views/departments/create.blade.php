@extends('layouts.app')

@section('content')
  <h1>Create New Department</h1>
    {!!Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST'])!!}
      {{ csrf_field() }}
      <div>
        {{Form::label('name', 'Department')}}
        {{Form::text('name', '', ['placeholder' => 'Department'])}}
      </div>
        {{Form::submit('Create Department')}}
    {!! Form::close() !!}
    </div>
  </form>
@endsection
