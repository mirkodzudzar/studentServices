<h1>{{$student->last_name}} {{$student->first_name}}</h1>
<h4>{{$student->department->name}}</h4>
<ol>
  <li>First name: <b>{{$student->first_name}}</b></li>
  <li>Last name: <b>{{$student->last_name}}</b></li>
  <li>Parent name: <b>{{$student->parent_name}}</b></li>
  <li>Gender: <b>{{$student->gender}}</b></li>
  <li>Date of birth: <b>{{$student->date_of_birth}}</b></li>
  <li>Place of birth: <b>{{$student->place_of_birth}}</b></li>
  <li>Personal identification number: <b>{{$student->personal_id_number}}</b></li>
  <li>Email: <b>{{$student->email}}</b></li>
  <li>Phone number: <b>{{$student->phone_number}}</b></li>
</ol>
