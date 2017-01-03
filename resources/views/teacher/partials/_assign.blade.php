
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
			@if (count($user->grade) != 0)
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab">
							<div class="row">
								<div class="col-md-8">
									<h5 class="panel-title">
										<a role="button" id="heading{{ str_slug($user->grade->slug) }}" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ str_slug($user->grade->slug) }}" aria-expanded="true" aria-controls="collapse{{ str_slug($user->grade->slug) }}">
											{{ $user->name }}</strong> is already class teacher at <b>{{ $user->grade->name }}</b>
										</a>
									</h5>
								</div>

								<div class="col-md-4">
									<button role="button" id="heading-delete-{{ str_slug($user->grade->slug) }}" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#accordion" href="#collapse-delete-{{ str_slug($user->grade->slug) }}"
										aria-expanded="true" aria-controls="collapse-delete-{{ str_slug($user->grade->slug) }}">
										Delete
									</button>
								</div>
							</div>
						</div>
						<div id="collapse{{ str_slug($user->grade->slug) }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{ str_slug($user->grade->slug) }}">
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="{{ route('assign.class', $user->id) }}">
									{{ csrf_field() }}

									<div class="form-group {{ $errors->has('stream') ? 'has-error' : ''}}">
										<label for="assignclassteacher" class="col-md-4 control-label">Change Class</label>
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
						<div id="collapse-delete-{{ str_slug($user->grade->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-{{ str_slug($user->grade->slug) }}">
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="{{ route('assign.destroy',[$id])}}">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<div class="form-group">
										<div class="col-md-12">
											<div class="alert alert-danger">
												Are you sure you want to delete <b>{{ $user->name }}</b> as <b>{{ $user->grade->slug }} class teacher</b>?, Click Delete to proceed.
											</div>
											<input type="hidden" name="delete" value="{{ $user->grade->slug }}">
											<input type="hidden" name="role" value="class_teacher">
										</div>
									</div>
									<div class="form-group">
											<div class="col-md-6">
													<button type="submit" class="btn btn-danger">
															Delete Records
													</button>
											</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			@else
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
			@endif
		</div>
		<div role="tabpanel" class="tab-pane" id="teacher">

			@if ($user->teacher)
				<div class="panel-group" id="teacher-accordion" role="tablist" aria-multiselectable="false" aria-expanded="false">
					@foreach ($user->teacher as $subject)
						<div class="panel panel-default">
							<div class="panel-heading" role="tab">
								<div class="row">
									<div class="col-md-8">
										<h5 class="panel-title">
											<a role="button" id="heading{{ str_slug($subject->slug) }}" data-toggle="collapse" data-parent="#teacher-accordion" href="#collapse{{ str_slug($subject->slug) }}" aria-expanded="true" aria-controls="collapse{{ str_slug($subject->slug) }}">
												<strong>{{ $user->name }}</strong> Teaches {{ $subject->slug }}
											</a>
										</h5>
									</div>

									<div class="col-md-4">
										<button role="button" id="heading-delete-{{ str_slug($subject->slug) }}" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#teacher-accordion" href="#collapse-delete-{{ str_slug($subject->slug) }}"
											aria-expanded="true" aria-controls="collapse-delete-{{ str_slug($subject->slug) }}">
											Delete
										</button>
									</div>
								</div>
							</div>
							<div id="collapse{{ str_slug($subject->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ str_slug($subject->slug) }}">
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="{{ route('assign.teacher', $user->id) }}">
										{{ csrf_field() }}

										<div class="form-group{{ $errors->has('class') ? 'has-error' : ''}}">
											<label for="" class="col-md-4 control-label">Change Class</label>
											@include('layouts.partials._gradelist')
										</div>

										<div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
											<label for="teacher_subject" class="col-md-4 control-label">Change Subject</label>
											@include('layouts.partials._subjectlist')
										</div>

										<div class="form-group">
									    <div class="col-md-6 col-md-offset-4 col-sm-offset-2 col-sm-10">
												<input type="hidden" name="update" value="{{ $subject->slug }}">
									    </div>
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
							<div id="collapse-delete-{{ str_slug($subject->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-{{ str_slug($subject->slug) }}">
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="post" action="{{ route('assign.destroy',[$id])}}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<div class="form-group">
											<div class="col-md-12">
												<div class="alert alert-danger">
													Are you sure you want to delete <b>{{ $user->name }}</b> as <b>{{ $subject->slug }} teacher</b>?, Click Delete to proceed.
												</div>
												<input type="hidden" name="delete" value="{{ $subject->slug }}">
												<input type="hidden" name="role" value="teacher">
											</div>
										</div>
										<div class="form-group">
												<div class="col-md-6">
														<button type="submit" class="btn btn-danger">
																Delete Records
														</button>
												</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					@endforeach
					<div class="panel panel-default">
						<div class="panel-heading">Assign Another Teacher Role to <strong>{{ $user->name }}</strong></div>
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
			@if ($user->hasRole('admin'))
				<div class="panel-group" id="admin-accordion" role="tablist" aria-multiselectable="false" aria-expanded="false">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab">
							<div class="row">
								<div class="col-md-8">
									<h5 class="panel-title">
										<a role="button" id="heading-admin" data-toggle="collapse" data-parent="#admin-accordion" href="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
											<strong>{{ $user->name }}</strong> Is already an administrator
										</a>
									</h5>
								</div>

								<div class="col-md-4">
									<button role="button" id="heading-delete-admin" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#admin-accordion" href="#collapseDeleteAdmin"
										aria-expanded="true" aria-controls="collapseDeleteAdmin">
										Delete
									</button>
								</div>
							</div>
						</div>
						<div id="collapseAdmin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-admin">
							<div class="panel-body">
								<div class="alert alert-info">
									<p>
										<strong>{{ $user->name }}</strong> Is already an administrator.
									</p>
								</div>
							</div>
						</div>
						<div id="collapseDeleteAdmin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-admin">
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="{{ route('assign.destroy',[$id])}}">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<div class="form-group">
										<div class="col-md-12">
											<div class="alert alert-danger">
												Are you sure you want to delete <b>{{ $user->name }}</b> as <b>administrator</b>?, Click Delete to proceed.
											</div>
											<input type="hidden" name="role" value="admin">
										</div>
									</div>
									<div class="form-group">
											<div class="col-md-6">
													<button type="submit" class="btn btn-danger">
															Delete Records
													</button>
											</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			@else
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
			@endif
		</div>
	</div>
</div>
