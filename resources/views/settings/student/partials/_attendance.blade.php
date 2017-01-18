@foreach ($attendance as $key => $value)
	<div id="student-activity" class="activity-listing student-activity" style="min-height: 126px;">
		<div class="student-activity-listing col-md-12 pull-left">
			<div class="profile-timeline discussion-timeline width-full">
				<h3 class="profile-timeline-month-heading bg-white h5">
					Last update on November <span class="text-muted">2016</span> see
					<a href="#">
						Activity logs
					</a>
				</h3>

				<div class="profile-rollup-wrapper py-4 pl-4 position-relative ml-0 details-container open">
					<span class="discussion-item-icon">
						<svg aria-hidden="true" class="octicon octicon-repo-push" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M4 3H3V2h1v1zM3 5h1V4H3v1zm4 0L4 9h2v7h2V9h2L7 5zm4-5H1C.45 0 0 .45 0 1v12c0 .55.45 1 1 1h4v-1H1v-2h4v-1H2V1h9.02L11 10H9v1h2v2H9v1h2c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1z"></path></svg>
					</span>
					<span class="muted-link no-underline col-md-12 profile-header">
						<span class="pull-left ">
						{{ $key }} Attendance for @ {{ $student->name }}
						</span>
						<span class="pull-right toggle-icon">
							<span class="profile-rollup-toggle-closed pull-right" aria-label="Collapse">
								<svg aria-hidden="true" class="octicon octicon-fold" height="28" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M7 9l3 3H8v3H6v-3H4l3-3zm3-6H8V0H6v3H4l3 3 3-3zm4 2c0-.55-.45-1-1-1h-2.5l-1 1h3l-2 2h-7l-2-2h3l-1-1H1c-.55 0-1 .45-1 1l2.5 2.5L0 10c0 .55.45 1 1 1h2.5l1-1h-3l2-2h7l2 2h-3l1 1H13c.55 0 1-.45 1-1l-2.5-2.5L14 5z"></path></svg>
							</span>
							<span class="profile-rollup-toggle-open pull-right" aria-label="Expand">
								<svg aria-hidden="true" class="octicon octicon-unfold" height="28" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M11.5 7.5L14 10c0 .55-.45 1-1 1H9v-1h3.5l-2-2h-7l-2 2H5v1H1c-.55 0-1-.45-1-1l2.5-2.5L0 5c0-.55.45-1 1-1h4v1H1.5l2 2h7l2-2H9V4h4c.55 0 1 .45 1 1l-2.5 2.5zM6 6h2V3h2L7 0 4 3h2v3zm2 3H6v3H4l3 3 3-3H8V9z"></path></svg>
							</span>
						</span>
					</span>
					<ul class="profile-rollup-content list-unstyled">
						@foreach ($value as $k => $v)
							<li class="ml-0 py-1 row">
								<div class="col-md-12">
									<span>{{ $v->quarter->name }}</span>
								</div>
								<div class="col-md-12">
									<div class="col-md-4">
										<span class="f4 ">{{ $v->quarter->months[0]->name }}</span>
										<span class="f4 muted-link ml-3 pull-right">{{ $v->first_month }}</span>
									</div>
									<div class="col-md-4">
										<span class="f4">{{ $v->quarter->months[1]->name }}</span>
										<span class="f4 muted-link ml-3 pull-right">{{ $v->second_month }}</span>
									</div>
									<div class="col-md-4">
										<span class="f4">{{ $v->quarter->months[2]->name }}</span>
										<span class="f4 muted-link ml-3 pull-right">{{ $v->third_month }}</span>
									</div>
								</div>
								<div class="col-md-12 py-1 mt-1">
									<span>Teacher remarks.</span>
									<blockquote class="f6">
										@if (count($v->comments))
											<span>
											{{ $v->comments }}
											</span>
											@else
											<span class="text-warning f6">
												No perfomance remarks have been given by the teacher !.
											</span>
										@endif
									</blockquote>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endforeach
