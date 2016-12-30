<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted"><strong>{{ $grade->name }}</strong> Students</h5>
			<div class="col-md-4">
				<div class="btn-group pull-right" role="group">
					<a href="{{ url('/grades') }}" class="btn btn-sm btn-default">Go Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<table id="data_{{ $slug }}" class="display" cellspacing="0" width="100%">
			<thead>
					<tr>
						<th class="col-md-3">Name</th>
						<th class="col-md-1">Gender</th>
						<th class="col-md-2">Age</th>
						<th class="col-md-3">Avg Perfomance</th>
					</tr>
			</thead>
			<tbody style="position:relative;">
				@foreach ($students as $student)
					<tr>
						<td class="col-md-3">
							{{ $student->name }}
						</td>
						<td class="col-md-1">
							{{ $student->gender }}
						</td>
						<td class="col-md-2">
							{{ $student->age() }}
						</td>
						<td class="col-md-2">
							<span class="badge pull-right" data-tooltip="Not Processed" title="Not Processed">NP</span>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
