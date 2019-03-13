{{ csrf_field() }}
<div>
  {{Form::label('first_name', 'First name')}}
  {{Form::text('first_name', '', ['placeholder' => 'First name'])}}
</div>
<div>
  {{Form::label('last_name', 'Last name')}}
  {{Form::text('last_name', '', ['placeholder' => 'Last name'])}}
</div>
<div>
  {{Form::label('parent_name', 'Parent name')}}
  {{Form::text('parent_name', '', ['placeholder' => 'Parent name'])}}
</div>
<div>
  {{Form::label('gender', 'Gender')}}<br>
  Male {{Form::radio('gender', 'Male', true)}}
  Female {{Form::radio('gender', 'Female')}}
</div>
<div>
  {{Form::label('date_of_birth', 'Date of birth')}}
  {{Form::text('date_of_birth', '', ['placeholder' => 'Date of birth'])}}
</div>
<div>
  {{Form::label('place_of_birth', 'Place of birth')}}
  {{Form::text('place_of_birth', '', ['placeholder' => 'Place of birth'])}}
</div>
<div>
  {{Form::label('personal_id_number', 'Personal identification number')}}
  {{Form::text('personal_id_number', '', ['placeholder' => 'Personal identification number'])}}
</div>
<div>
  {{Form::label('email', 'Email')}}
  {{Form::email('email', '', ['placeholder' => 'Email'])}}
</div>
<div>
  {{Form::label('phone_number', 'Phoone number')}}
  {{Form::text('phone_number', '', ['placeholder' => 'Phone number'])}}
</div>
<div>
  {{Form::submit($submitButtonText)}}
</div>
