@if (count($user->teacher) != 0 )
	<div class="panel-group" id="teacher-accordion" role="tablist" aria-multiselectable="false" aria-expanded="false">
		@foreach ($user->teacher as $teacher)
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<div class="row">
						<div class="col-md-8">
							<h5 class="panel-title">
								<a role="button" id="heading{{ str_slug($teacher->slug) }}" data-toggle="collapse" data-parent="#teacher-accordion" href="#collapse{{ str_slug($teacher->slug) }}" aria-expanded="true" aria-controls="collapse{{ str_slug($teacher->slug) }}">
									<strong>{{ $user->name }}</strong> Teaches {{ $teacher->slug }}
								</a>
							</h5>
						</div>

						<div class="col-md-4">
							<button role="button" id="heading-delete-{{ str_slug($teacher->slug) }}" class="btn btn-xs btn-danger pull-right" data-toggle="collapse" data-parent="#teacher-accordion" href="#collapse-delete-{{ str_slug($teacher->slug) }}"
								aria-expanded="true" aria-controls="collapse-delete-{{ str_slug($teacher->slug) }}">
								Delete
							</button>
						</div>
					</div>
				</div>
				<div id="collapse{{ str_slug($teacher->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ str_slug($teacher->slug) }}">
					@include('teacher.partials.subviews.teacher._edit')
				</div>
				<div id="collapse-delete-{{ str_slug($teacher->slug) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-delete-{{ str_slug($teacher->slug) }}">
					@include('teacher.partials.subviews.teacher._delete')
				</div>
			</div>
		@endforeach
		@include('teacher.partials.subviews.teacher._create')
	</div>
	@else
		@include('teacher.partials.subviews.teacher._create')
@endif
