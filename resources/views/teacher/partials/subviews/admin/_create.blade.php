<div class="panel panel-default">
	<div class="panel-heading">Assign School Administrator Role to <strong>{{ $user->name }}</strong></div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('assignadmin.update', $user->id) }}">
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
						Assign Role
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
