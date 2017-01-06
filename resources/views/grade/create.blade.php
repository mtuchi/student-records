@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h5 class="col-md-8 text-left text-capitalize text-muted">Add Grade Records</h5>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                {{-- <a href="#" class="btn btn-primary btn-sm">Use Excel</a> --}}
	                <a href="{{ url('/grades') }}" class="btn btn-default btn-sm">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{ url('/grades') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Grade</label>
									@include('layouts.partials._gradelist')
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label"> Teacher</label>
								<div class="col-md-6">
									<select class="form-control" name="teacher">
										<option value="">Select Teacher</option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
													Add Grade
											</button>
									</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
