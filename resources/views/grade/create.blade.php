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
								<div class="col-md-6">
									@include('layouts.partials._gradelist')
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4 control-label"> Class Teacher</label>
								<div class="col-md-6">
									<select class="selectpicker" name="teacher" multiple data-max-options="1" data-live-search="true"
									 title="Choose a class teacher...">
										@foreach ($users as $user)
										<option value="{{ $user->id }}" data-tokens="{{ $user->name }}">{{ $user->name }}</option>
										@endforeach
									</select>

								</div>
							</div>

							<div class="form-group">
								<label for="tagsinput" class="col-md-4 control-label">Select Subjects</label>
								<div class="col-md-6">
									@include('layouts.partials._subjectlist')
								</div>
							</div>

							<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary col-md-8">
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
