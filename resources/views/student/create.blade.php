@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h5 class="col-md-8 text-left text-capitilize text-muted">Add Student Records</h5>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                <a href="#" class="btn btn-sm btn-primary">Use Excel</a>
	                <a href="{{ url('/students') }}" class="btn btn-sm btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{ url('/students') }}">
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Full Name</label>
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
								<label for="gender" class="col-md-4 control-label">Gender</label>
								<div class="col-md-6">
									<select class="form-control" name="gender" required>
										<option value="">Select Gender</option>
										<option value="m">Male</option>
										<option value="f">Female</option>
									</select>
								</div>
							</div>

							<div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
								<label for="dob" class="col-md-4 control-label">Date Of Birth</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>
									@if ($errors->has('dob'))
											<span class="help-block">
													<strong>{{ $errors->first('dob') }}</strong>
											</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('guardian') ? ' has-error' : '' }}">
								<label for="guardian" class="col-md-4 control-label">Parent or Guardian</label>
								<div class="col-md-6">
									<input id="guardian" type="text" class="form-control" name="guardian" value="{{ old('guardian')  }}" required>
									@if ($errors->has('guardian'))
											<span class="help-block">
													<strong>{{ $errors->first('guardian') }}</strong>
											</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
								<label for="phone" class="col-md-4 control-label">Phone number</label>
								<div class="col-md-6">
									<input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
									@if ($errors->has('phone'))
											<span class="help-block">
													<strong>{{ $errors->first('phone') }}</strong>
											</span>
									@endif
								</div>
							</div>

							<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
													Add Records
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
