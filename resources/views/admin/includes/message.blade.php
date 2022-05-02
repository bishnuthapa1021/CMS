@if ($errors->any())
<div class="alert alert-danger">
    <ul style="list-style:none">
        @foreach ($errors->all() as $error )
        <li> {{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('info-message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{Session::get('info-message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
@if (Session::has('error-message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{Session::get('error-message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
