<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted">Delete <strong>{{ $subject->name }}</strong> Records</h5>
			<div class="col-md-4">
				<div class="btn-group pull-right" role="group">
					<a href="{{ url('/subjects') }}" class="btn btn-default btn-sm">Go Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		@if ($score)
			<div class="alert alert-warning">
				<p class="form-control-static">
					You can not delete <b>{{ $subject->name }}</b> subject, because it's already assinged to classes.
				</p>
			</div>
			@else
				<form class="form-horizontal" role="form" method="post" action="{{ route('subjects.destroy',[$id])}}">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<div class="form-group">
						<div class="col-md-12">
							<div class="alert alert-warning">
								<p class="form-control-static">
									<strong>Warning!</strong> Once you delete  <b>{{ $subject->name }}</b> all records will be deleted too!.
								</p>
							</div>
							<div class="alert alert-danger">
								<p class="form-control-static">
									Are you sure you want to delete <b>{{ $subject->name }}</b>?, Click Delete to proceed.
								</p>
							</div>
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
		@endif

	</div>
</div>
