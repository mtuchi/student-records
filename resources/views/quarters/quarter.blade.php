@extends('home')

@section('stdsubject.content')

<div class="panel" style="padding-left:1em;">
  <div class="row">
    <h4 class="col-xs-12 col-sm-8 col-md-8">
      <svg aria-hidden="true" class="octicon octicon-repo" height="16" version="1.1" viewBox="0 0 12 16" width="12">
      <path d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>
      <span class="author" itemprop="author">
      <a href="#" class="url link" rel="author">{{$user}}</a>
      </span>
      <span class="path-divider">/</span>
      <strong>
      <a href="#">{{ $subject }}</a>
      </strong>
    </h4>
    <ul class="nav nav-tabs col-xs-12 col-sm-8" role="tablist" style="margin-bottom:-2px;">
      @foreach($quarters as $quarter)
        @if($loop->first)
          <li role="presentation" class="active"><a style="border-left:none;" href="#{{ $quarter->slug}}" aria-controls="{{ $quarter->slug}}" role="tab" data-toggle="tab">{{ $quarter->name }}</a></li>
        @else
          <li role="presentation"><a href="#{{ $quarter->slug }}" aria-controls="{{ $quarter->slug}}" role="tab" data-toggle="tab">{{ $quarter->name }}</a></li>
        @endif
      @endforeach
    </ul>
  </div>
</div>
<!-- Tab panes -->
<div class="tab-content">
@foreach($quarters as $quarter)

  @if($loop->first)
    <div role="tabpanel" class="tab-pane active" id="{{ $quarter->slug }}">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard
          <div class="pull-right" style="margin-top:-7.5px;">
            <a href="{{ route('export.show',[$grade->slug, $subject])}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('upload.show',[$grade->slug, $subject])}}" class="btn btn-primary">Upload Worksheet <i class="glyphicon glyphicon-download"></i></a>
          </div>
        </div>
          <div class="panel-body">
            <table id="data_{{ $quarter->slug }}" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>First Month</th>
                    <th>Second Month</th>
                    <th>Third Month</th>
                  </tr>
              </thead>
              <tbody style="position:relative;">
                @if(count($quarter->score))
                  @foreach($quarter->score as $score)
                    <tr class="record-row">
                      <td>{{$score->student->name}}</td>
                      <td>{{ $score->student->gender }}</td>
                      <td>{{ $score->first_month }}</td>
                      <td>{{ $score->second_month }}</td>
                      <td>{{ $score->third_month }}</td>
                      <td class="actions">
                        <a href="{{ route('score.show', [$grade->slug, $subject, $quarter->slug, $score->student->id]) }}" class="btn-link btn-xs text-info text-uppercase"> <b>edit</b></a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  @foreach($students as $student)
                    <tr>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->gender }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td style="position:absolute; width:65%; bottom:0; top:0;right:0.5em;">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="{{ route('export.show',[$grade->slug, $subject])}}" class="alert-link">Download Spreed Sheet</a>
                            to fill student scores
                          </div>
                        </div>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
        </div>
      </div>
    </div>
  @else
    <div role="tabpanel" class="tab-pane" id="{{ $quarter->slug }}">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard
          <div class="pull-right" style="margin-top:-7.5px;">
            <a href="{{ route('export.show',[$grade->slug, $subject])}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('upload.show',[$grade->slug, $subject])}}" class="btn btn-primary">Upload Worksheet <i class="glyphicon glyphicon-download"></i></a>
          </div>
        </div>
          <div class="panel-body">
            <table id="data_{{ $quarter->slug }}" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>First Month</th>
                      <th>Second Month</th>
                      <th>Third Month</th>
                  </tr>
              </thead>
              <tbody  style="position:relative;">
                @if(count($quarter->score))
                  @foreach($quarter->score as $score)
                    <tr class="record-row">
                      <td>{{$score->student->name}}</td>
                      <td>{{ $score->student->gender }}</td>
                      <td>{{ $score->first_month }}</td>
                      <td>{{ $score->second_month }}</td>
                      <td>{{ $score->third_month }}</td>
                      <td class="actions">
                        <a href="{{ route('score.show', [$grade->slug, $subject, $quarter->slug, $score->student->id]) }}" class="btn-link btn-xs text-info text-uppercase"> <b>edit</b></a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  @foreach($students as $student)
                    <tr>
                      <td>{{ $student->name }}</td>
                      <td>{{ $student->gender }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td style="position:absolute; width:65%; bottom:0; top:0;right:0.5em;">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="{{ route('export.show',[$grade->slug,$subject])}}" class="alert-link">Download Spreed Sheet</a>
                            to fill student scores
                          </div>
                        </div>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
        </div>
      </div>
    </div>
  @endif
@endforeach
</div>
@endsection
