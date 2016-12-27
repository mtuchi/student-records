@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h4 class="col-md-8 text-uppercase text-muted">{{ $user->name }} Records</h4>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                <a href="{{ url('/teachers') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->name }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->username }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->email }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Gender</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->gender }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Date Of Birth</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->dob }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Phone number</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $user->phone }}
									</p>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
