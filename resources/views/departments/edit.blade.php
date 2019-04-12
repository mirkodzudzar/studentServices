@extends('layouts.app')

@section('content')
  <h1>Edit Subject</h1>
    {!! Form::model($department, ['method' => 'POST', 'action' => ['DepartmentsController@update', $department->id]]) !!}
      {{ csrf_field() }}
      <div>
        {{Form::label('name', 'Department')}}
        {{Form::text('name', $department->name, ['placeholder' => 'Department'])}}
      </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Edit Department')}}
    {!! Form::close() !!}
    </div>
  </form>
@endsection
