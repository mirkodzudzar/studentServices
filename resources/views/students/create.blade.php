@extends('layouts.app')

@section('content')
  <a href="/students">Go Back</a>
  <h1>Create New Student</h1>
    {!!Form::open(['action' => 'StudentsController@store', 'method' => 'POST'])!!}
      @include('students.form', ['submitButtonText' => 'Create Student'])
    {!! Form::close() !!}
    </div>
  </form>
@endsection
