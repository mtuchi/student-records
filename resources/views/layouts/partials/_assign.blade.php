<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted">Assign <strong>{{ $student->name }}</strong> to a class</h5>
			<div class="col-md-4">
				<div class="btn-group pull-right" role="group">
					<a href="#" class="btn btn-sm btn-primary">Use Excel</a>
					<a href="{{ url('/students') }}" class="btn btn-sm btn-default">Go Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('assign.edit', $student->id) }}">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('stream') ? 'has-error' : ''}}">
				<label for="assignclassteacher" class="col-md-4 control-label">Assign Class</label>
				@include('layouts.partials._gradelist')
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary btn-block">
						Save Records
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
