<div id="collapseDeleteAdmin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-admin">
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('assignadmin.destroy',[$id])}}">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<div class="form-group">
				<div class="col-md-12">
					<div class="alert alert-danger">
						Are you sure you want to delete <b>{{ $user->name }}</b> as <b>administrator</b>?, Click Delete to proceed.
					</div>
					<input type="hidden" name="role" value="admin">
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
	</div>
</div>
