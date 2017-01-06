@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h5 class="col-md-8 text-capitalize text-muted">Add Teacher Records</h5>
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
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
									@if ($errors->has('name'))
											<span class="help-block">
													<strong>{{ $errors->first('name') }}</strong>
											</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
									<input id="username" type="text" class="form-control" name="username" value="{{ old('username')  }}" required>
									@if ($errors->has('username'))
											<span class="help-block">
													<strong>{{ $errors->first('username') }}</strong>
											</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
									@if ($errors->has('email'))
											<span class="help-block">
													<strong>{{ $errors->first('email') }}</strong>
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
								<label for="gender" class="col-md-4 control-label">Date Of Birth</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>
									@if ($errors->has('dob'))
											<span class="help-block">
													<strong>{{ $errors->first('dob') }}</strong>
											</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
								<label for="gender" class="col-md-4 control-label">Phone number</label>
								<div class="col-md-6">
									<input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
									@if ($errors->has('phone'))
											<span class="help-block">
													<strong>{{ $errors->first('phone') }}</strong>
											</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password" class="col-md-4 control-label">Password</label>

									<div class="col-md-6">
											<input id="password" type="password" class="form-control" name="password" required>

											@if ($errors->has('password'))
													<span class="help-block">
															<strong>{{ $errors->first('password') }}</strong>
													</span>
											@endif
									</div>
							</div>

							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
									<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

									<div class="col-md-6">
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required>

											@if ($errors->has('password_confirmation'))
													<span class="help-block">
															<strong>{{ $errors->first('password_confirmation') }}</strong>
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
	    <div class="col-xs-6 col-md-4 col-sm-6">
				@include('layouts.partials.sidebar')
			</div>
		</div>
	</div>
@endsection
