<style media="screen">
  .custom-position{
    position: fixed;
    top: 10px;
    left: 0;
    right: 0;
    margin: 0 auto;
    z-index: 1040;
    box-sizing: border-box;
    width: 350px;
  }
</style>
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
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('global'))
    <div class="alert alert-warning">
        {{ session('global') }}
    </div>
@endif
