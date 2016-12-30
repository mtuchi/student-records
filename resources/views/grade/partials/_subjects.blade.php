<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted"><strong>{{ $grade->name }}</strong> Subjects</h5>
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
						<th class="col-md-3">Subject</th>
						<th class="col-md-3">Teacher</th>
						<th class="col-md-2">Units</th>
					</tr>
			</thead>
			<tbody style="position:relative;">
				@foreach ($subjects as $subject)
					<tr>
						<td class="col-md-3">
							{{ $subject->name }}
						</td>
						<td class="col-md-3">
							<span class="badge pull-right" data-tooltip="Not Processed" title="Not Processed">NP</span>
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
