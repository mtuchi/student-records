@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h5 class="col-md-8 text-capitalize text-muted">Add Subject Record</h5>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                {{-- <a href="#" class="btn btn-primary">Use Excel</a> --}}
	                <a href="{{ url('/subjects') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{ route('subjects.store') }}">
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Subject Name</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
									@if ($errors->has('name'))
											<span class="help-block">
													<strong>{{ $errors->first('name') }}</strong>
											</span>
									@endif
								</div>
							</div>

							<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
													Add Record
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
