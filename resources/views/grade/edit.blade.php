@extends('home')

@section('main.content')
<div class="container">
  <div class="row">
      <div class="col-md-8 row">
				<div class="col-md-3">
				  <!-- Nav tabs -->
				  <ul class="nav nav-pills nav-stacked" id="myTab" role="tablist">
						<li role="presentation" class="active"><a href="#assign" aria-controls="assign" role="tab" data-toggle="tab">Class Teacher</a></li>
				    <li role="presentation"><a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Delete</a></li>
				  </ul>
				</div>
				<!-- Tab panes -->
			  <div class="tab-content col-md-9">
					<div role="tabpanel" class="tab-pane active" id="assign">
						@include('grade.partials._assign')
					</div>
			    <div role="tabpanel" class="tab-pane" id="delete">
            <div class="panel panel-default">
    					<div class="panel-heading">
    	          <div class="row">
    	            <h5 class="col-md-8 text-left text-capitalize text-muted">Delete <strong>{{ $grade->name }}</strong> Records</h5>
    	            <div class="col-md-4">
    	              <div class="btn-group pull-right" role="group">
    	                <a href="#" class="btn btn-sm btn-primary">Use Excel</a>
    	                <a href="{{ url('/grades') }}" class="btn btn-sm btn-default">Go Back</a>
    	              </div>
    	            </div>
    	          </div>
    					</div>
    					<div class="panel-body">
    						<form class="form-horizontal" role="form" method="post" action="{{ route('grade.destroy',[$slug])}}">
    							{{ csrf_field() }}
    							{{ method_field('DELETE') }}
    							<div class="form-group">
    								<div class="col-md-12">
    									<div class="alert alert-danger">
    										<p class="form-control-static">
    											Are you sure you want to delete <b>{{ $grade->name }}</b> ?
    										</p>
    									</div>
    								</div>
    							</div>
    							<div class="form-group">
    									<div class="col-md-6">
  											<button type="submit" class="btn btn-danger">
  													Save Records
  											</button>
    									</div>
    							</div>
    						</form>
    					</div>
    				</div>
					</div>
			  </div>
      </div>
  </div>
</div>
@endsection
