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
	                <li>
	                  <a href="#score" class="underline-nav-item" aria-controls="score" role="tab" data-toggle="tab">
	                     Scores
	                  </a>
	                </li>
	                @if (Auth::user()->hasRole('class_teacher'))
                  <li>
                    <a href="#attendance" class="underline-nav-item " aria-controls="attendance" role="tab" data-toggle="tab">
                      Attendance
                    </a>
                  </li>
	                @endif
                  {{-- Check if its quarterly report or monthly or anual report first --}}
                  <li>
                    <a href="#report" class="" aria-controls="report" role="tab" data-toggle="tab">Report</a>
                  </li>
								</ul>
							</div>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="profile">
									@include('settings.student.partials._profile')
								</div>
								<div role="tabpanel" class="tab-pane" id="score">
									<div class="boxed-group-inner">
										<h2 class="f4 mb-2 text-normal">
												Scores overview
										</h2>
										@include('settings.student.partials._scores')
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="attendance">
									<div class="boxed-group-inner">
										<h2 class="f4 mb-2 text-normal">
												Attendance overview
										</h2>
										@include('settings.student.partials._attendance')
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="report">
									<div class="boxed-group-inner col-md-12">
										<h2 class="f4 mb-2 text-normal hidden">
												{{ $student->name }} Report
										</h2>
										@include('settings.student.partials._report')
									</div>
								</div>
							</div>
						</div>
          </div>
        </div>
        <div class="col-md-4">
          @include('layouts.partials.sidebar')
        </div>
      </div>
    </div>
@endsection
