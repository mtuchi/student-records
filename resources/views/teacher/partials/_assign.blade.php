<div class="row">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" style="margin-bottom:1em;">
			<li role="presentation" class="active"><a href="#classteacher" aria-controls="classteacher" role="tab" data-toggle="tab">Class Teacher</a></li>
			<li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
			<li role="presentation"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Administrator</a></li>
		</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="classteacher">
			<div class="panel panel-default">
				<div class="panel-heading">Assign Class Teacher Role to <strong>{{ $user->name }}</strong></div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{ route('assign.class', $user->id) }}">
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
		</div>
		<div role="tabpanel" class="tab-pane" id="teacher">
			@if (count($user->subjects) === 1)
				<div class="panel panel-default">
					@foreach ($user->subjects as $subject)
						<div class="panel-heading"><strong>{{ $user->name }}</strong> Teaches {{ $subject->slug }} </div>
					@endforeach
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('assign.teacher', $user->id) }}">
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
										Save Changes
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
							<form class="form-horizontal" role="form" method="POST" action="{{ route('assign.teacher', $user->id) }}">
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

		</div>
		<div role="tabpanel" class="tab-pane" id="admin">
			<div class="panel panel-default">
				<div class="panel-heading">Assign School Administrator Role to <strong>{{ $user->name }}</strong></div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('assign.admin', $user->id) }}">
						{{ csrf_field() }}

						<div class="form-group">
							<div class="col-md-12">
								<p class="form-control-static alert alert-warning">
									Please review the Administrator <strong><a href="#">guide</a></strong>  for more information.
								</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<button type="submit" class="btn btn-primary btn-block">
									Assign Role
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
