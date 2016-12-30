@if ($grade->user)
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<h5 class="col-md-8 text-left text-capitalize text-muted">Change {{ $grade->user[0]->name }} as <b>{{ $grade->name }} class teacher</b> </h5>
				<div class="col-md-4">
					<div class="btn-group pull-right" role="group">
						<a href="#" class="btn btn-sm btn-primary">Use Excel</a>
						<a href="{{ url('/grades') }}" class="btn btn-sm btn-default">Go Back</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{ route('grade.update',[$slug])}}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<div class="form-group">
					<label for="name" class="col-md-4 control-label">Teacher</label>
					<div class="col-md-6">
						<select class="form-control" name="teacher">
							@foreach ($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
							@foreach ($grade->user as $user)
								<option value="{{ $user->id }}" selected="">{{ $user->name }}</option>
							@endforeach
						</select>
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
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<h5 class="col-md-8 text-left text-capitalize text-muted">Assign a class teacher to <b>{{ $grade->name }}</b> </h5>
					<div class="col-md-4">
						<div class="btn-group pull-right" role="group">
							<a href="#" class="btn btn-sm btn-primary">Use Excel</a>
							<a href="{{ url('/grades') }}" class="btn btn-sm btn-default">Go Back</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="post" action="{{ route('grade.update',[$slug])}}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}

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
											Save Records
									</button>
							</div>
					</div>
				</form>
			</div>
		</div>
@endif
