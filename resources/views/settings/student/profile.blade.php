@extends('layouts.app')

@section('content')
  <div class="container">
	    <div class="row">
        <div class="col-xs-6 col-md-4 ">
          <div class="user-profile">
            <div class="user-profile-sticky-bar js-user-profile-sticky-bar hidden">
              <div class="user-profile-mini-vcard d-table">
                <span class="user-profile-mini-avatar d-table-cell center-block">
                  <img alt="@mtuchi" class="img-rounded" src="{{ $student->avatar(['size' => 64])}}" width="32" height="32">
                </span>
                <span class="d-table-cell v-align-middle lh-condensed js-user-profile-following-mini-toggle">
                  <strong>{{ $student->name }}</strong>
                </span>
              </div>
            </div>
            <a href="#" aria-label="Change your avatar" class="card-avatar show tooltipped tooltipped-s">
              <img alt="" class="avatar width-full img-circle" src="{{ $student->avatar(['size' =>460]) }}" width="150" height="150">
            </a>
            <div class="card-names-container js-user-profile-sticky-fields is-placeholder"></div>
            <div class="card-names-container" >
              <h2 class="card-names">
                <span class="card-fullname show">{{ $student->name }}</span>
              </h2>
            </div>
            <div class="user-profile-bio">
              <div class="text-muted">
                <a href="#" class="">Edit profile bio</a>
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
                <span class="fa fa-gender"></span>
                {{ $student->gender }}
              </dd>

              <dd aria-label="Member since" class="card-detail">
                <svg aria-hidden="true" class="icon-clock" height="16" version="1.1" viewBox="0 0 14 16" width="14">
                  <path fill-rule="evenodd" d="M8 8h3v2H7c-.55 0-1-.45-1-1V4h2v4zM7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7z"></path></svg>
                <span class="join-label">Joined on </span>
                <local-time class="join-date" datetime="2014-02-05T08:13:14Z" day="numeric" month="short" year="numeric" title="5 Feb 2014 11:13 GMT +3">{{ $student->joined() }}</local-time>
              </dd>
            </dl>

            <div class="border-top clearfix">
              <h2 class="mb-1 h4">Grade</h2>
                <a href="{{ config('app.url') }}" aria-label="{{ config('app.name') }}" class="tooltipped tooltipped-n avatar-group-item" itemprop="follows">
                  <img alt="@{{ config('app.name') }}" class="avatar img-circle" src="{{ $student->avatar(['size'=> 35,'image' => 'retro']) }}" width="35" height="35">
                </a>
                <span></span>
            </div>
          </div>

        </div>

        <div class="col-xs-12 col-sm-6 col-md-8">
          <div class="user-profile-nav js-sticky">
            <nav class="underline-nav">
              <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                  <a href="#overview" class="underline-nav-item" aria-controls="overview" role="tab" data-toggle="tab">
                    Overview
                  </a>
                </li>
                <li>
                  <a href="#score" class="underline-nav-item" aria-controls="score" role="tab" data-toggle="tab">
                     Scores
                     <span class="badge">
                       9
                     </span>
                  </a>
                </li>
                <li>
                  <a href="#attendance" class="underline-nav-item " aria-controls="attendance" role="tab" data-toggle="tab">
                    Attendance
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
                    Scores overview
                  <span class="pinned-repos-reorder-error js-pinned-repos-reorder-error"></span>
                </h2>

                @foreach($results as $result)
                  @foreach ($result->score as $score)
                    <div class="profile-timeline-card-wrapper" style="margin:1em 0;">
                      <div class="profile-timeline-card bg-white border border-gray-dark">
                        <svg aria-hidden="true" class="octicon octicon-repo" height="16" version="1.1" viewBox="0 0 12 16" width="12">
                        <path d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>

                        <span class="f6 text-">
                          <a href="#" class="text-bold">
                            <span class="subj js-subj" title="subject-name">{{ $score->subject->name }}</span>
                          </a>
                        </span>
                        <br />
                        <blockquote class="h5">
                          <h3 class="h4">
                            <a href="" class="text-gray-dark">{{ $score->quarter->name }} <strong class="text-info">Scores</strong></a>
                          </h3>
                          <dl class="h6">
                            <dt>{{ $result->months[0]->name }}</dt>
                            <dd>{{ $score->first_month}}</dd>
                            <dt>{{ $result->months[1]->name }}</dt>
                            <dd>{{ $score->second_month}}</dd>
                            <dt>{{ $result->months[2]->name }}</dt>
                            <dd>{{ $score->third_month }}</dd>
                          </dl>
                        </blockquote>
                      </div>
                    </div>
                  @endforeach
                @endforeach
              </div>
              <div role="tabpanel" class="tab-pane" id="score">

              </div>
              <div role="tabpanel" class="tab-pane" id="attendance">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
@endsection
