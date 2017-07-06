@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h4 class="col-md-8 text-uppercase text-muted">{{ $subject->name }} Records</h4>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                <a href="{{ url('/subjects') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Subject Name</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $subject->name }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Update At</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{ $subject->updated_at->diffForHumans() }}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Created By</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{-- {{ $subject->updated_at->diffForHumans() }} --}}
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Units</label>
								<div class="col-md-6">
									<p class="form-control-static">
										{{-- {{ $subject->updated_at->diffForHumans() }} --}}
									</p>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
