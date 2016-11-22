@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4">
          <div class="panel">
            <div class="panel-heading">
                Settings.
            </div>
            <div class="panel-body">
              @include('layouts.partials._settingsnavigation')
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
          <div class="tab-content" id="settings-tabcontent">
            <div class="tab-pane fade active in" role="tabpanel" id="profile" aria-labelledby="profile-tab">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="">Profile</h4>
                  <h4 class="pull-right btn btn-link">Back</h4>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="media">
                      <div class="media-left media-top col-md-3" style="background:;">
                        <a href="#">
                          <img class="media-object img-circle center-block" src="https://secure.gravatar.com/avatar/a2496d197a781b43e8b1c35987e96fbb?default=identicon&amp;secure=true" alt="...">
                        </a>
                      </div>
                      <div class="media-body" style="background:;">
                        <h4 class="media-heading">username</h4>
                        <ul class="list-group">
                          <li class="">email@irabu.co.tz</li>
                          <li class="">Joined since 06/16/2016</li>
                        </ul>
                      </div>
                    </div>
                    @include('settings.edit.profile')
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="subjects" aria-labelledby="subjects-tab">
              <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">

                </div>
              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="activity" aria-labelledby="activity-tab">
              <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
