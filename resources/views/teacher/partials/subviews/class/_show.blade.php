@if (count($user->grade) != 0)
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab">
				<div class="row">
					@foreach ($user->grade as $grade)
						<div class="col-md-8">
							<h5 class="panel-title">
								<a role="button" id="heading{{ str_slug($grade->slug) }}" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ str_slug($grade->slug) }}" aria-expanded="true" aria-controls="collapse{{ str_slug($grade->slug) }}">
									{{ $user->name }}</strong> is already class teacher at <b>{{ $grade->name }}</b>
								</a>
							</h5>
						</div>

						<div class="col-md-4">
							<button role="button" id="heading-delete-{{ str_slug($grade->slug) }}" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#accordion" href="#collapse-delete-{{ str_slug($grade->slug) }}"
							aria-expanded="true" aria-controls="collapse-delete-{{ str_slug($grade->slug) }}">
							Delete
							</button>
						</div>
					@endforeach
				</div>
			</div>
			@include('teacher.partials.subviews.class._edit')
			@include('teacher.partials.subviews.class._delete')
		</div>
	</div>
	@else
		@include('teacher.partials.subviews.class._create')
@endif
