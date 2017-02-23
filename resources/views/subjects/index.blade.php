@extends('home')

@section('main.content')
	@if (Auth::user()->hasRole('admin'))
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12 col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="pull-left" style="margin-left:20px;">
									<a href="{{ url('/subjects/create') }}" class="btn btn-default">+ Add Subject</a>
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
											Subject Name
										</th>
										<th class="col-md-3">
											{{-- Units --}}
										</th>
										<th class="col-md-3">
											{{-- Created By --}}
										</th>
										<th class="col-md-3">
											Updated At
										</th>
									</tr>
								</thead>
								<tbody style="position:relative;">
									@if ($subjects->count())
										@foreach ($subjects as $subject)
											<tr class="record-row">
												<td class="col-md-3">
													<div class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
														{{ $subject->name }} <span class="caret"></span>
														</a>
														<ul class="dropdown-menu dropdown-menu-right" role="menu">
															<li>
																<a href="{{ route('subjects.show',[$subject->id])}}">Show</a>
															</li>
															<li>
																<a href="{{ route('subjects.edit',[$subject->id])}}">Edit</a>
															</li>
														</ul>
													</div>
												</td>
												<td class="col-md-3">
													{{-- {{ $subject->units }} --}}
												</td>
												<td class="col-md-3">
													{{-- {{ $subject->user }} --}}
												</td>
												<td class="col-md-3">
													{{ $subject->updated_at->diffForHumans()}}
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="5" style="padding:;" class="alert alert-info text-center">
												<a href="{{ url('/subjects/create') }}">+ Add Subject Records</a>
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
	@endif
@endsection
