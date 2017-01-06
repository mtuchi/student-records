@extends('home')

@section('main.content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="pull-left" style="margin-left:20px;">
							<a href="{{ url('/students/create') }}" class="btn btn-default">+ Add Student</a>
						</div>
						<div class="pull-right hidden" style="margin-right:20px;">
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
								<th class="col-md-1">
									Gender
								</th>
								<th class="col-md-2">
									DOB
								</th>
								<th class="col-md-3">
									Guardian
								</th>
								<th class="col-md-2">
									Emergency
								</th>
							</tr>
						</thead>
						<tbody style="position:relative;">
							@if ($students->count())
								@foreach ($students as $student)
									<tr class="record-row">
										<td class="col-md-3">
											<div class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
												{{ $student->name }} <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right" role="menu">
													<li>
														<a href="{{ route('student.show',[$student->id])}}">Profile</a>
													</li>
													<li>
														<a href="{{ route('student.edit',[$student->id])}}">Settings</a>
													</li>
												</ul>
											</div>
										</td>
										<td class="col-md-1">
											{{ $student->gender }}
										</td>
										<td class="col-md-2">
											{{ $student->dob }}
										</td>
										<td class="col-md-3">
											{{ $student->guardian }}
										</td>
										<td class="col-md-2">
											{{ $student->emergency_contact }}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5" style="padding:;" class="alert alert-info text-center">
										<a href="#">+ Add Student Records</a>
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
