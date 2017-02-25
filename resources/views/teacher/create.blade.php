@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h5 class="col-md-8 text-capitalize text-muted">Invite Teaachers</h5>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                {{-- <a href="#" class="btn btn-primary">Use Excel</a> --}}
	                <a href="{{ url('/teachers') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{ url('/teachers/create') }}">
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<select id="select-to" class="form-control contacts" placeholder="Add some people..." name="email" multiple></select>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary col-md-12">
													Invite Teachers
											</button>
									</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	    <div class="col-xs-6 col-md-4 col-sm-6">
				@include('layouts.partials._sidebar')
			</div>
		</div>
	</div>
@endsection
