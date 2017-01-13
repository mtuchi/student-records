
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered">
				<thead>
					<tr role="row">
						<th class="text-center" rowspan="1" colspan="10" style="vertical-align: middle;">Academic Progress Report</th>
						<th rowspan="1">
							<img src="http://s3.amazonaws.com/s3.codecourse.com/public/img/email/logo.png" alt="Codecourse logo" class="pull-">
						</th>
					</tr>
				    <tr role="row">
				        <th colspan="1" rowspan="2" style="vertical-align: middle;">Pupil's Name</th>
				        <th colspan="8" rowspan="2" style="vertical-align: middle;">Jaden Smith Maeda</th>
				        <th colspan="2" rowspan="1">Pre-Standard I A</th>
				    </tr>

					<tr>
						<th rowspan="1">Absences:</th>
						<th rowspan="1">N/A</th>
					</tr>

					<tr role="row">
				        <th class="sorting" rowspan="1">Subject</th>
				        <th class="sorting" rowspan="1" colspan="3">Teacher</th>
				        <th class="sorting" rowspan="1">Q.1</th>
				        <th class="sorting" rowspan="1">Q.2</th>
						<th class="sorting" rowspan="1">Q.3</th>
						<th class="sorting" rowspan="1">Q.4</th>
				        <th class="sorting" rowspan="1">Term 1</th>
						<th class="sorting" rowspan="1">Term 2</th>
						<th class="sorting" rowspan="1">Cumm Avg.</th>
				    </tr>
				</thead>
				<tbody>
					<tr>
						<td rowspan="1">English</td>
						<td rowspan="1" colspan="3">Jane Doe</td>
						<td rowspan="1">98</td>
						<td rowspan="1">79</td>
						<td rowspan="1">89</td>
						<td rowspan="1">91</td>
						<td rowspan="1">12</td>
						<td rowspan="1">12</td>
						<td rowspan="1">54</td>
					</tr>
					<tr>
						<td rowspan="1">Overall Average</td>
						<td rowspan="1" colspan="3"></td>
						<td rowspan="1">98</td>
						<td rowspan="1">79</td>
						<td rowspan="1">89</td>
						<td rowspan="1">91</td>
						<td rowspan="1">12</td>
						<td rowspan="1">12</td>
						<td rowspan="1">54</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
