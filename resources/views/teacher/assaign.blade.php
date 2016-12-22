@extends('home')

@section('main.content')
<div class="container">
    <div class="row">
        <div class="col-md-8 row">
					<div class="col-md-4">
					  <!-- Nav tabs -->
					  <ul class="nav nav-pills nav-stacked" role="tablist">
					    <li role="presentation" class="active"><a href="#classteacher" aria-controls="classteacher" role="tab" data-toggle="tab">Class Teacher</a></li>
					    <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
					    <li role="presentation"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">School Admin</a></li>
					    <li role="presentation"><a href="#registrar" aria-controls="registrar" role="tab" data-toggle="tab">Registrar</a></li>
					  </ul>
					</div>
					<!-- Tab panes -->
				  <div class="tab-content col-md-8">
						<div role="tabpanel" class="tab-pane active" id="classteacher">
							<div class="panel panel-default">
								<div class="panel-heading">Assaign Class Teacher Role to <strong>{{ $user->name }}</strong></div>
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="post" action="{{ route('assaign.edit', $user->id) }}">
										{{ csrf_field() }}

										<div class="form-group {{ $errors->has('stream') ? 'has-error' : ''}}">
											<label for="assaignclassteacher" class="col-md-4 control-label">Assaign Class</label>
											@include('teacher.partials._gradelist')
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
							<div class="panel panel-default">
								<div class="panel-heading">Assaign Teacher Role to <strong>{{ $user->name }}</strong></div>
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="#">
										{{ csrf_field() }}

										<div class="form-group{{ $errors->has('class') ? 'has-error' : ''}}">
											<label for="" class="col-md-4 control-label">Assaign Class</label>
											@include('teacher.partials._gradelist')
										</div>

										<div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
											<label for="teacher_subject" class="col-md-4 control-label">Assaign Subject</label>
											@include('teacher.partials._subjectlist')
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
				    <div role="tabpanel" class="tab-pane" id="admin">
							<div class="panel panel-default">
								<div class="panel-heading">Assaign School Admin Role to <strong>{{ $user->name }}</strong></div>
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="#">
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
													Assaign Role
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
				    <div role="tabpanel" class="tab-pane" id="registrar">...</div>
				  </div>
        </div>
    </div>
</div>
@endsection
