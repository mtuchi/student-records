@extends('layouts.app')

@section('content')
  <div class="container">
	    <div class="row">
        <div class="col-xs-6 col-md-3">
          <div class="user-profile">
            <div class="user-profile-sticky-bar js-user-profile-sticky-bar hidden">
              <div class="user-profile-mini-vcard d-table">
                <span class="user-profile-mini-avatar d-table-cell center-block">
                  <img alt="@mtuchi" class="img-rounded" src="{{ $user->avatar(['size' => 64])}}" width="32" height="32">
                </span>
                <span class="d-table-cell v-align-middle lh-condensed js-user-profile-following-mini-toggle">
                  <strong>{{ $user->username }}</strong>
                </span>
              </div>
            </div>
            <a href="#" aria-label="Change your avatar" class="card-avatar show tooltipped tooltipped-s">
              <img alt="" class="avatar width-full img-circle" src="{{ $user->avatar(['size' =>460]) }}" width="150" height="150">
            </a>
            <div class="card-names-container js-user-profile-sticky-fields is-placeholder"></div>
            <div class="card-names-container" >
              <h2 class="card-names">
                <span class="card-fullname show">{{ $user->name }}</span>
                <span class="card-username show text-muted h4">{{ $user->username }}</span>
              </h2>
            </div>
            <div class="user-profile-bio">
              <div class="text-muted">
                <a href="#" class="">Edit your profile bio</a>
              </div>
            </div>

            <dl class="card-details border-gray-light">
              <dd aria-label="Organization" class="card-detail">
                <svg aria-hidden="true" class="icon-organization" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                  <path fill-rule="evenodd" d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3
                  .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3
                  .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4">
                  </path>
                </svg>
                {{ config('app.url') }}
              </dd>

              <dd aria-label="Email" class="card-detail">
                <svg aria-hidden="true" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M0 4v8c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H1c-.55 0-1 .45-1 1zm13 0L7 9 1 4h12zM1 5.5l4 3-4 3v-6zM2 12l3.5-3L7 10.5 8.5 9l3.5 3H2zm11-.5l-4-3 4-3v6z"></path></svg>
                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
              </dd>
              <dd aria-label="Member since" class="card-detail">
                <svg aria-hidden="true" class="icon-clock" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                  <path fill-rule="evenodd" d="M8 8h3v2H7c-.55 0-1-.45-1-1V4h2v4zM7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7z"></path></svg>
                <span class="join-label">Joined on </span>
                <local-time class="join-date" datetime="2014-02-05T08:13:14Z" day="numeric" month="short" year="numeric" title="5 Feb 2014 11:13 GMT +3">{{ $user->joined() }}</local-time>
              </dd>
            </dl>

            <div class="border-top clearfix">
              <h2 class="mb-1 h4">Organizations</h2>
                <a href="{{ config('app.url') }}" aria-label="{{ config('app.name') }}" class="tooltipped tooltipped-n avatar-group-item" itemprop="follows">
                  <img alt="@{{ config('app.name') }}" class="avatar img-circle" src="{{ $user->avatar(['size'=> 35,'image' => 'retro']) }}" width="35" height="35">
                </a>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="user-profile-nav js-sticky">
            <nav class="underline-nav">
              <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                  <a href="#overview" class="underline-nav-item" aria-controls="overview" role="tab" data-toggle="tab">
                    Overview
                  </a>
                </li>
                <li>
                  <a href="#subject" class="underline-nav-item" aria-controls="subject" role="tab" data-toggle="tab">
                     Subjects
                     <span class="badge">
											 @if (Auth::user()->hasRole('teacher'))
												 {{ $teachers->count() }}
											 @endif
                     </span>
                  </a>
                </li>
                <li>
                  <a href="#activity" class="underline-nav-item " aria-controls="activity" role="tab" data-toggle="tab">
                    Activity
                    <span class="badge">
											@if (Auth::user()->hasRole('teacher'))
												{{ $activities->count() }}
											@endif
                    </span>
                  </a>
                </li>
                <li class="hidden">
                  <a href="#" class="underline-nav-item" aria-selected="false" role="tab">
                    Followers
                    <span class="badge">
                      7
                    </span>
                  </a>
                </li>
                <li class="hidden">
                  <a href="#" class="underline-nav-item " aria-selected="false" role="tab">
                    Following
                    <span class="badge">
                      7
                    </span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="subj-filter">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="overview">
                <h2 class="f4 mb-2 text-normal">
                    Subjects overview
                  <span class="pinned-repos-reorder-error js-pinned-repos-reorder-error"></span>
                </h2>
                <ol class="pinned-subjs-list row">
									@if (Auth::user()->hasRole('teacher'))
										@foreach($teachers as $teacher)
	                    <li class="pinned-subj-item col-md-5 border-gray-dark">
	                      <span class="pinned-subj-item-content">
	                        <span class="show">
	                            <a href="" class="text-bold">
	                           <span class="subj js-subj" title="subject-name">{{ $teacher->subject->name }}</span>
	                            </a>
	                        </span>

	                        <p class="text-gray text-small">subject assaigned by <a href="#">Academic Head</a></p>

	                        @if($teacher->subject->description)
	                        <p class="pinned-subj-desc text-gray text-small show">
	                          {{ $teacher->subject->description }}
	                        </p>
	                        @else
	                        <p class="pinned-subj-desc text-gray text-small show">
	                          <blockquote class="h5">
	                            Subject description is not set
	                            Please add subject description
	                            <a href="#">subject description</a>
	                          </blockquote>
	                        </p>
	                        @endif

	                        <p class="teacher-name text-gray">
	                          <span class="subj-language-color pinned-subj-meta" style="background-color:#f1e05a;"></span>
	                          {{ $teacher->teacher->name }}
	                        </p>
	                      </span>
	                    </li>
	                  @endforeach
									@endif
                </ol>

                <div class="col-md-12 ">
                  <h4 class="h4 text-normal" style="margin: 0 1em 0 -1em;">
                    Overview activity
                    <span class="overviews-setting pull-right hidden">
                      <div class="dropdown">
                        <a class="btn btn-link dropdown-toggle" id="jump-to" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="" role="button">
                          Jump to <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="jump-to">
                          <li class="dropdown-header">Quarter Activity</li>
                          <li>
                            <a class="dropdown-item" href="">First</a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="">Second</a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="">Third</a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="">Fourth</a>
                          </li>
                        </ul>
                      </div>
                        <div class="dropdown">
                          <a class="btn btn-link dropdown-toggle" id="by-year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="" role="button">
                            Timeline<span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="by-year">
                            <li class="dropdown-header">
                              Profile timeline year list
                            </li>
                            <li>
                              <a href="#" id="year-link-2016" class="link">2016</a>
                            </li>
                            <li>
                              <a href="#" id="year-link-2015" class="link">2015</a>
                            </li>
                            <li>
                              <a href="" id="year-link-2014" class="link"> 2014</a>
                            </li>
                          </ul>
                        </div>
                    </span>
                  </h4>
                </div>
                @include('settings.partials.timeline')
              </div>
              <div role="tabpanel" class="tab-pane" id="subject">
                @include('settings.partials.subjects')
              </div>
              <div role="tabpanel" class="tab-pane" id="activity">
                @include('settings.partials.activity')
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          @include('layouts.partials._sidebar')
        </div>
      </div>
    </div>
	</div>
@endsection
