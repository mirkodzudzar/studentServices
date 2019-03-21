@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div>
          <span>
            <strong>{{$error}}</strong>
          </span>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div>
      <span>
        <strong>{{session('success')}}</strong>
      </span>
    </div>
@endif

@if(session('error'))
    <div>
      <span>
        <strong>{{session('error')}}</strong>
      </span>
    </div>
@endif
