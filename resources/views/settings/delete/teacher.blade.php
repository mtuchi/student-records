@extends('home')

@section('main.content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
	          <div class="row">
	            <h4 class="col-md-8 text-center text-uppercase text-muted">Delete <strong>{{ $user->name }}</strong> Records</h4>
	            <div class="col-md-4">
	              <div class="btn-group pull-right" role="group">
	                <a href="#" class="btn btn-primary">Use Excel</a>
	                <a href="{{ url('/teacherlist') }}" class="btn btn-default">Go Back</a>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{ route('teacher.destroy',[$id])}}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<div class="form-group">
								<div class="col-md-12">
									<div class="alert alert-warning">
										<p class="form-control-static">
											<strong>Warning! Once you delete  {{ $user->name }} all records will be deleted too</strong>
										</p>
									</div>
									<div class="alert alert-danger">
										<p class="form-control-static">
											Are you sure you want to delete {{ $user->name }} ?
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
		</div>
	</div>
@endsection
