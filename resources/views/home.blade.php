@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <div class="dashboard-notice js-notice">
                  <h2>Welcome to the <strong>Gonzaga</strong> Records Manager!</h2>

                  <p>Here are some quick tips for a first-time teacher member.</p>
                  <ul>
                    <li>
                      Use the link on your right panel to switch to your subject context.
                    </li>
                    <li>
                      After you switch context you'll see student scores dashboard that lists out
                      student score per quarter.
                    </li>
                    <li>
                      To upload students scores, First download the spreedsheet schema,
                      i.e The schema will contain student names and quarter fieldset that you will have to fill
                    </li>

                  </ul>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading">Subject assaigned to </div>
                <div class="panel-body">
                  <div class="boxed-group-inner">
                    <ul class="mini-subject-list js-subject-list">
                      <li class="public source ">
                        <a href="/Happyr/LinkedIn-API-client" class="mini-subject-list-item css-truncate">
                          <span class="subject-and-owner css-truncate-target">
                            <span class="subject" title="LinkedIn-API-client">Biology</span>
                        </span>
                        </a>
                      </li>
                      <li class="public source ">
                        <a href="/pagekit/docs" class="mini-subject-list-item css-truncate">
                          <span class="subject-and-owner css-truncate-target">
                            <span class="subject" title="docs">English</span>
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
