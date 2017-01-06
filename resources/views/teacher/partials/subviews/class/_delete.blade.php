@foreach ($user->grade as $grade)
	<div id="collapse-delete-{{ str_slug($grade->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-{{ str_slug($grade->slug) }}">
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{ route('assignclass.destroy',[$id])}}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<div class="form-group">
					<div class="col-md-12">
						<div class="alert alert-danger">
							Are you sure you want to delete <b>{{ $user->name }}</b> as <b>{{ $grade->slug }} class teacher</b>?, Click Delete to proceed.
						</div>
						<input type="hidden" name="delete" value="{{ $grade->slug }}">
						<input type="hidden" name="role" value="class_teacher">
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
@endforeach
