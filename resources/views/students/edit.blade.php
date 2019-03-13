@extends('layouts.app')

@section('content')
  <h1>Edit Student</h1>
  {!! Form::model($student, ['method' => 'PATCH', 'action' => ['StudentsController@update',$student->id]]) !!}
		@include('students.form2', ['submitButtonText' => 'Edit student'])
	{!! Form::close() !!}
@endsection
