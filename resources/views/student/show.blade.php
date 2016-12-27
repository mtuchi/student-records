@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h4 class="col-md-8 text-uppercase text-muted"><b>{{ $student->name }}</b> Records</h4>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                <a href="{{ url('/students') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Full Name</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $student->name }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Gender</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $student->gender }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="dob" class="col-md-4 control-label">Date of Birth</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $student->dob }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="guardian" class="col-md-4 control-label">Parent or Guardian</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $student->guardian }}
									</p>
								</div>
							</div>

							<div class="form-group">
								<label for="emergency_contact" class="col-md-4 control-label">Emergency number</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $student->emergency_contact }}
									</p>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
