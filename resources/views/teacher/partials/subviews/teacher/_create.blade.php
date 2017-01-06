
@if (count($user->teacher) != 0 )
	<div class="panel panel-default">
		<div class="panel-heading">Assign Another Teacher Role to <strong>{{ $user->name }}</strong></div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('assignteacher.update', $user->id) }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('class') ? 'has-error' : ''}}">
					<label for="" class="col-md-4 control-label">Assign Class</label>
					@include('layouts.partials._gradelist')
				</div>

				<div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
					<label for="teacher_subject" class="col-md-4 control-label">Assign Subject</label>
					@include('layouts.partials._subjectlist')
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
@else
	<div class="panel panel-default">
		<div class="panel-heading">Assign Teacher Role to <strong>{{ $user->name }}</strong></div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('assignteacher.update', $user->id) }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('class') ? 'has-error' : ''}}">
					<label for="" class="col-md-4 control-label">Assign Class</label>
					@include('layouts.partials._gradelist')
				</div>

				<div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
					<label for="teacher_subject" class="col-md-4 control-label">Assign Subject</label>
					@include('layouts.partials._subjectlist')
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
@endif
