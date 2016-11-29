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

            <dl class="card-details border-gray-light">
              <dd aria-label="Organization" class="card-detail">
                <svg aria-hidden="true" class="icon-organization" height="16" version="1.1" viewBox="0 0 16 16" width="16">
                  <path fill-rule="evenodd" d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3
                  .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3
                  .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4">
                  </path>
                </svg>
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
                  <a href="#score" class="underline-nav-item" aria-controls="score" role="tab" data-toggle="tab">
                     Scores
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="subj-filter">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="score">
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
                            <svg aria-hidden="true" class="octicon octicon-repo-push" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M4 3H3V2h1v1zM3 5h1V4H3v1zm4 0L4 9h2v7h2V9h2L7 5zm4-5H1C.45 0 0 .45 0 1v12c0 .55.45 1 1 1h4v-1H1v-2h4v-1H2V1h9.02L11 10H9v1h2v2H9v1h2c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1z"></path></svg>
                          </span>
                          <span class="muted-link no-underline col-md-12 profile-header">
                            <span class="pull-left ">
                            {{ $key }} Scores
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
