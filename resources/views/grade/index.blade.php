@extends('home')

@section('main.content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="pull-left" style="margin-left:20px;">
							<a href="{{ url('/grades/create') }}" class="btn btn-default">+ Add Grade</a>
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
									Grade
								</th>
								<th class="col-md-3">
									Class Teacher
								</th>
								<th class="col-md-3">
									Subjects
								</th>
								<th class="col-md-3">
									Students
								</th>
							</tr>
						</thead>
						<tbody style="position:relative;">
							@if ($grades->count())
								@foreach ($grades as $grade)
									<tr class="record-row">
										<td class="col-md-3">
											<div class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
												{{ $grade->name }} <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right" role="menu">
													<li>
														<a href="{{ route('grade.show',[$grade->slug])}}">Profile</a>
													</li>
													<li>
														<a href="{{ route('grade.edit',[$grade->slug])}}">Settings</a>
													</li>
												</ul>
											</div>
										</td>
										<td class="col-md-3">
											<span class="text-muted">Not Assigned</span>
										</td>
										<td class="col-md-3">
											<span class="text-muted">Not assign</span>
										</td>
										<td class="col-md-3">
											<span class="text-muted">Not assign</span>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5" style="padding:;" class="alert alert-info text-center">
										<a href="{{ url('/grades/create') }}">+ Add Grade Records</a>
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
