@extends('home')

@section('stdsubject.content')

<div class="panel" style="background:transparent; padding-left:1em;">
  <div class="row">
    <h4 class="col-xs-12 col-sm-8 col-md-8">
      <svg aria-hidden="true" class="octicon octicon-repo" height="16" version="1.1" viewBox="0 0 12 16" width="12">
      <path d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>
      <span class="author" itemprop="author">
      <a href="#" class="url link" rel="author">{{$user}}</a>
      </span>
      <span class="path-divider">/</span>
      <strong>
      <a href="#">{{ $subject->name }}</a>
      </strong>
    </h4>
    <ul class="nav nav-tabs col-xs-12 col-sm-8" role="tablist" style="margin-bottom:-2px;">
      <li role="presentation" class="active"><a href="#first_quater" aria-controls="first_quater" role="tab" data-toggle="tab">First Quater</a></li>
      <li role="presentation"><a href="#second_quater" aria-controls="second_quater" role="tab" data-toggle="tab">Second Quater</a></li>
      <li role="presentation"><a href="#third_quater" aria-controls="third_quater" role="tab" data-toggle="tab">Third Quater</a></li>
      <li role="presentation"><a href="#fourth_quater" aria-controls="fourth_quater" role="tab" data-toggle="tab">Fourth Quater</a></li>
    </ul>
  </div>
</div>
<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="first_quater">
    <div class="panel panel-default">
      <div class="panel-heading">Dashboard
        <div class="row container">
          <p>Worksheet</p>
          <button type="button" name="button" class="btn btn-success">Download Sheet</button>
          <a href="#" class="btn btn-primary">Upload Worksheet <i class="glyphicon glyphicon-download"></i></a>
        </div>
      </div>
        <div class="panel-body">
        First Quater
      </div>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane" id="second_quater">
    <div class="panel panel-default">
      <div class="panel-heading">Dashboard and Filters</div>
        <div class="panel-body">
        Second Quater
      </div>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane" id="third_quater">
    <div class="panel panel-default">
      <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
        Third Quater

      </div>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane" id="fourth_quater">
    <div class="panel panel-default">
      <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
        Fourth Quater

      </div>
    </div>
  </div>
</div>
@endsection
