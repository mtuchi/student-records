<div class="panel panel-default">
	<div class="panel-heading">Assign class teacher role to <strong>{{ $user->name }}</strong></div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('assignclass.update', $user->id) }}">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('stream') ? 'has-error' : ''}}">
				<label for="assignclassteacher" class="col-md-4 control-label">Assign Class</label>
				@include('layouts.partials._gradelist')
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary btn-block">
						Add Records
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
