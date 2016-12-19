@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="pull-left" style="margin-left:20px;">
							<a href="#" class="btn btn-default">+ Add Teacher</a>
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
							BOD
						</th>
						<th class="col-md-2">
							Subjects
						</th>
						<th class="col-md-2">
							Class
						</th>
					</tr>
					</thead>
					<tbody style="position:relative;">
					<tr class="record-row hidden">
						<td class="col-md-3">
							<div class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Siku Nyingine <span class="caret"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li>
									<a href="">Edit</a>
									</li>
									<li><a href="">Profile</a></li>
								</ul>
							</div>
						</td>
						<td class="col-md-2">
							Male
						</td>
						<td class="col-md-2">
							Main
						</td>
						<td class="col-md-2">
							No Harm
						</td>
						<td class="col-md-2">
							Activity
						</td>
					</tr>
					<tr>
						<td colspan="5" style="padding:;" class="alert alert-info text-center">
							<a href="#">+ Add Teacher Records</a>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-4 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					School Management Section
				</div>
				<div class="panel-body">
					<div class="boxed-group-inner">
						<ul class="mini-class-list js-class-list">
							<li><a href="">Teachers</a></li>
							<li><a href="">Students</a></li>
							<li><a href="">Grades</a></li>
							<li><a href="">Subjects</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
