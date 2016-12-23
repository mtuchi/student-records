@extends('home')

@section('main.content')
<div class="container">
  <div class="row">
      <div class="col-md-8 row">
				<div class="col-md-3">
				  <!-- Nav tabs -->
				  <ul class="nav nav-pills nav-stacked" role="tablist">
				    <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a></li>
				    <li role="presentation"><a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Delete</a></li>
            <li role="presentation"><a href="#suspend" aria-controls="suspend" role="tab" data-toggle="tab">Suspend</a></li>
				  </ul>
				</div>
				<!-- Tab panes -->
			  <div class="tab-content col-md-9">
					<div role="tabpanel" class="tab-pane active" id="edit">
            <div class="panel panel-default">
    					<div class="panel-heading">
    	          <div class="row">
    	            <h4 class="col-md-8 text-center text-uppercase text-muted">Edit <b>{{ $student->name }}</b> Record</h4>
    	            <div class="col-md-4">
    	              <div class="btn-group pull-right" role="group">
    	                <a href="#" class="btn btn-primary">Use Excel</a>
    	                <a href="{{ url('/students') }}" class="btn btn-default">Go Back</a>
    	              </div>
    	            </div>
    	          </div>
    					</div>
    					<div class="panel-body">
    						<form class="form-horizontal" role="form" method="post" action="{{ route('student.update',[$id])}}">
    							{{ csrf_field() }}
    							{{ method_field('PUT') }}

    							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    								<label for="name" class="col-md-4 control-label">Full Name</label>
    								<div class="col-md-6">
    									<input id="name" type="text" class="form-control" name="name" value="{{ $student->name ? $student->name : old('name')  }}" autofocus>
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
    										@if (($student->gender !='m') && ($student->gender !='f'))
    											<option value="">Select Gender</option>
    										@endif
    										<option value="m" {{ $student->gender == 'm' ? 'selected' : '' }}>Male</option>
    										<option value="f" {{ $student->gender == 'f' ? 'selected' : '' }}>Female</option>
    									</select>
    								</div>
    							</div>
                  <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
    								<label for="gender" class="col-md-4 control-label">Date Of Birth</label>
    								<div class="col-md-6">
    									<input type="date" class="form-control" name="dob" value="{{ $student->DOB ? $student->DOB : old('dob')  }}" required>
    									@if ($errors->has('dob'))
    											<span class="help-block">
    													<strong>{{ $errors->first('dob') }}</strong>
    											</span>
    									@endif
    								</div>
    							</div>
                  <div class="form-group{{ $errors->has('guardian') ? ' has-error' : '' }}">
    								<label for="name" class="col-md-4 control-label">Parent or Guardian</label>
    								<div class="col-md-6">
    									<input id="guardian" type="text" class="form-control" name="guardian" value="{{ $student->guardian ? $student->guardian : old('guardian')  }}" required>
    									@if ($errors->has('guardian'))
    											<span class="help-block">
    													<strong>{{ $errors->first('guardian') }}</strong>
    											</span>
    									@endif
    								</div>
    							</div>

    							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    								<label for="gender" class="col-md-4 control-label">Phone number</label>
    								<div class="col-md-6">
    									<input type="tel" name="phone" class="form-control" value="{{ $student->phone ? $student->phone : old('phone')  }}" required>
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
					</div>
			    <div role="tabpanel" class="tab-pane" id="delete">
            <div class="panel panel-default">
    					<div class="panel-heading">
    	          <div class="row">
    	            <h4 class="col-md-8 text-center text-uppercase text-muted">Delete <strong>{{ $student->name }}</strong> Records</h4>
    	            <div class="col-md-4">
    	              <div class="btn-group pull-right" role="group">
    	                <a href="#" class="btn btn-primary">Use Excel</a>
    	                <a href="{{ url('/students') }}" class="btn btn-default">Go Back</a>
    	              </div>
    	            </div>
    	          </div>
    					</div>
    					<div class="panel-body">
    						<form class="form-horizontal" role="form" method="post" action="{{ route('student.destroy',[$id])}}">
    							{{ csrf_field() }}
    							{{ method_field('DELETE') }}
    							<div class="form-group">
    								<div class="col-md-12">
    									<div class="alert alert-danger">
    										<p class="form-control-static">
    											Are you sure you want to delete {{ $student->name }} ?
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
			    <div role="tabpanel" class="tab-pane" id="suspend">
            <div class="panel panel-default">
    					<div class="panel-heading">
    	          <div class="row">
    	            <h4 class="col-md-8 text-center text-uppercase text-muted">Suspend <strong>{{ $student->name }}</strong> Records</h4>
    	            <div class="col-md-4">
    	              <div class="btn-group pull-right" role="group">
    	                <a href="#" class="btn btn-primary">Use Excel</a>
    	                <a href="{{ url('/students') }}" class="btn btn-default">Go Back</a>
    	              </div>
    	            </div>
    	          </div>
    					</div>
    					<div class="panel-body">
    						<div class="alert alert-warning">
    						  Throw a warning here!
    						</div>
    					</div>
    				</div>
          </div>
			  </div>
      </div>
  </div>
</div>
@endsection
