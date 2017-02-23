@if(notify()->ready())
  <div class="container">
    <div class="row center-block">
      <div class="alert alert-message alert-{{ notify()->type() }} alert-dismissible col-md-4  custom-position" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong class="text-capitalize">{{ notify()->type() }}!</strong> {!! notify()->message() !!}
      </div>
    </div>
  </div>
@endif

@if (session('status'))
  <div class="container">
    <div class="row center-block">
      <div class="alert alert-message alert-info alert-dismissible col-md-4  custom-position" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong class="text-capitalize">Info!</strong> {{ session('status') }}
      </div>
    </div>
  </div>
@endif
