<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted">Edit Teacher Records</h5>
			<div class="col-md-4">
				<div class="btn-group pull-right" role="group">
					<a href="#" class="btn btn-primary btn-sm">Use Excel</a>
					<a href="{{ url('/teachers') }}" class="btn btn-default btn-sm">Go Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('teacher.update',[$id])}}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Name</label>
				<div class="col-md-6">
					<input id="name" type="text" class="form-control" name="name" value="{{ $user->name ? $user->name : old('name')  }}" autofocus>
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
					<input id="username" type="text" class="form-control" name="username" value="{{ $user->username ? $user->username : old('username')  }}" required>
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
					<input id="email" type="email" class="form-control" name="email" value="{{ $user->email ? $user->email : old('email')  }}" required>
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
						@if (($user->gender !='m') && ($user->gender !='f'))
							<option value="">Select Gender</option>
						@endif
						<option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>Male</option>
						<option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>Female</option>
					</select>
				</div>
			</div>
			<div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
				<label for="gender" class="col-md-4 control-label">Date Of Birth</label>
				<div class="col-md-6">
					<input type="date" class="form-control" name="dob" value="{{ $user->dob ? $user->dob : old('dob')  }}" required>
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
					<input type="tel" name="phone" class="form-control" value="{{ $user->phone ? $user->phone : old('phone')  }}" required>
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
									Save Records
							</button>
					</div>
			</div>
		</form>
	</div>
</div>
