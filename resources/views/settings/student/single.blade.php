@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8">
          <div class="user-profile-nav js-sticky">
            <div class="tabbable-panel">
						  <div class="tabbable-line">
							  <ul class="nav nav-tabs nav-justified">
									<li class="active">
	                  <a href="#profile" class="underline-nav-item" aria-controls="profile" role="tab" data-toggle="tab">
	                     Profile
	                  </a>
	                </li>
	                <li class="">
	                  <a href="#score" class="underline-nav-item" aria-controls="score" role="tab" data-toggle="tab">
	                     Scores
	                  </a>
	                </li>
								</ul>
							</div>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="profile">
									<div class="col-xs-6 col-md-12">
											<div class="user-profile">
												<div class="user-profile-sticky-bar hidden">
													<div class="user-profile-mini-vcard d-table">
														<span class="user-profile-mini-avatar d-table-cell center-block">
															<img alt="" class="img-rounded" src="{{ $student->avatar(['size' => 64])}}" width="32" height="32">
														</span>
														<span class="js-user-profile-following-mini-toggle">
															<strong>{{ $student->name }}</strong>
														</span>
													</div>
												</div>
												<a href="#" aria-label="Change your avatar" class="card-avatar hidden tooltipped ">
													<img alt="" class="avatar width-full img-circle" src="{{ $student->avatar(['size' => 460])}}" width="150" height="150">
												</a>
												<div class="card-names-container js-user-profile-sticky-fields is-placeholder"></div>
												<div class="card-names-container" >
													<h2 class="card-names">
														<span class="card-fullname show">{{ $student->name }}</span>
													</h2>
												</div>

												<dl class="card-details border-gray-light">
													<dd aria-label="Organization" class="card-detail">
          									<img src="/build/svg/organization.svg"></img>
														<span class="fa fa-gender"></span>
														@if (count($student->gender))
															@if ($student->gender == "m")
																{{ "Male" }}
															@else
																{{ "Female" }}
															@endif
														@endif
													</dd>

													<dd aria-label="Member since" class="card-detail">
          									<img src="/build/svg/clock.svg"></img>
                            <span class="join-label">Joined on </span>
														<local-time class="join-date" datetime="2014-02-05T08:13:14Z" day="numeric" month="short" year="numeric" title="5 Feb 2014 11:13 GMT +3">{{ $student->joined() }}</local-time>
													</dd>
												</dl>
												<div class="border-top clearfix">
												<h2 class="mb-1 h4">Grade</h2>
												<a href="{{ config('app.url') }}" aria-label="{{ config('app.name') }}" class="tooltipped tooltipped-n avatar-group-item" itemprop="follows">
													<img alt="@{{ config('app.name') }}" class="avatar img-circle" src="{{ $student->avatar(['size'=> 35,'image' => 'retro']) }}" width="35" height="35">
												</a>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="score">
									<h2 class="f4 mb-2 text-normal">
											Scores overview
									</h2>
									@foreach ($scores as $key => $value)
										<div id="student-activity" class="activity-listing student-activity" style="min-height: 126px;">
											<div class="student-activity-listing col-md-12 pull-left">
												<div class="profile-timeline discussion-timeline width-full">
													<h3 class="profile-timeline-month-heading bg-white h5 hidden">
														Last update on November <span class="text-muted">2016</span> see
														<a href="#">
															Activity logs
														</a>
													</h3>

													<div class="profile-rollup-wrapper py-4 pl-4 position-relative ml-0 details-container open">
														<span class="discussion-item-icon">
            									<img src="/build/svg/repo-push.svg"></img>
                            </span>
														<span class="muted-link no-underline col-md-12 profile-header">
															<span class="pull-left ">
															{{ $key }} Scores
															</span>
															<span class="pull-right toggle-icon">
																<span class="profile-rollup-toggle-closed pull-right" aria-label="Collapse">
                									<img src="/build/svg/fold.svg"></img>
                                </span>
																<span class="profile-rollup-toggle-open pull-right" aria-label="Expand">
                									<img src="/build/svg/unfold.svg"></img>
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
								</div>
							</div>
						</div>
          </div>
        </div>
        <div class="col-md-4">
          @include('layouts.partials._sidebar')
        </div>
      </div>
    </div>
@endsection
