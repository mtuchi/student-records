<div class="panel-group" id="admin-accordion" role="tablist" aria-multiselectable="false" aria-expanded="false">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab">
			<div class="row">
				<div class="col-md-8">
					<h5 class="panel-title">
						<a role="button" id="heading-admin" data-toggle="collapse" data-parent="#admin-accordion" href="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
							<strong>{{ $user->name }}</strong> Is already an administrator
						</a>
					</h5>
				</div>

				<div class="col-md-4">
					<button role="button" id="heading-delete-admin" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#admin-accordion" href="#collapseDeleteAdmin"
						aria-expanded="true" aria-controls="collapseDeleteAdmin">
						Delete
					</button>
				</div>
			</div>
		</div>
		<div id="collapseAdmin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-admin">
			<div class="panel-body">
				<div class="alert alert-info">
					<p>
						<strong>{{ $user->name }}</strong> Is already an administrator.
					</p>
				</div>
			</div>
		</div>
		@include('teacher.partials.subviews.admin._delete')
	</div>
</div>
