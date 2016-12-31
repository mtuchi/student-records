@extends('home')

@section('main.content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="pull-left" style="margin-left:20px;">
							<a href="{{ url('/teachers/create') }}" class="btn btn-default">+ Add Teacher</a>
						</div>
						<div class="pull-right" style="margin-right:20px;">
							<a href="" class="btn btn-success">Download Sheet</a>
							<a href="" class="btn btn-primary">Upload Worksheet <i class="fa fa-download"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<table id="data_" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="col-md-3">
									Name
								</th>
								<th class="col-md-2">
									Gender
								</th>
								<th class="col-md-2">
									DOB
								</th>
								<th class="col-md-2">
									Roles
								</th>
								<th class="col-md-2">
									Email
								</th>
							</tr>
						</thead>
						<tbody style="position:relative;">
							@if ($teachers->count())
								@foreach ($teachers as $teacher)
									<tr class="record-row">
										<td class="col-md-3">
											<div class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
												{{ $teacher->name }} <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right" role="menu">
													<li>
														<a href="{{ route('teacher.show',[$teacher->id])}}">Profile</a>
													</li>
													<li>
														<a href="{{ route('teacher.edit',[$teacher->id])}}">Settings</a>
													</li>
												</ul>
											</div>
										</td>
										<td class="col-md-2">
											{{ $teacher->gender }}
										</td>
										<td class="col-md-2">
											{{ $teacher->dob }}
										</td>
										<td class="col-md-2">
											@foreach ($teacher->roles as $role)
												@if ($role->name == "admin")
													<span class="badge" data-toggle="tooltip" data-placement="top" title="School Admin"> A </span>
												@elseif ($role->name == "teacher")
													<button class="btn btn-xs bg-muted" type="button" data-toggle="tooltip" data-placement="top" title="Subject Teacher">
													 T <span class="badge">{{ count($teacher->teacher) }}</span>
													</button>
												@elseif ($role->name == "class_teacher")
													<span class="badge" data-toggle="tooltip" data-placement="top" title="Class Teacher">C T</span>
												@elseif ($role->name == "registrar")
													<span class="badge" data-toggle="tooltip" data-placement="top" title="Class Teacher">R</span>
												@endif
											@endforeach
										</td>
										<td class="col-md-2">
											{{ $teacher->email }}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5" style="padding:;" class="alert alert-info text-center">
										<a href="#">+ Add Teacher Records</a>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
