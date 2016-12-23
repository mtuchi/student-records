@extends('home')

@section('main.content')

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
    <ul class="nav nav-tabs col-xs-12 col-sm-8" role="tablist" style="margin-bottom:-2px;" id="quarter-tabs">
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
            <a href="{{ route('exportscore.show',[$grade->slug, $subject])}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('uploadscore.show',[$grade->slug, $subject])}}" class="btn btn-primary">Upload Worksheet <i class="fa fa-download"></i></a>
          </div>
        </div>
          <div class="panel-body">
            <table id="data_{{ $quarter->slug }}" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">Gender</th>
                    @foreach($quarter->months as $month)
                      <th class="col-md-2">{{ $month['name']}}</th>
                    @endforeach
                  </tr>
              </thead>
              <tbody style="position:relative;">
                @if(count($quarter->score))
                  @foreach($quarter->score as $score)
                    <tr class="record-row">
                      <td class="col-md-3">
                        <div class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $score->student->name }} <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                              <a href="{{ route('score.show', [$grade->slug, $subject, $quarter->slug, $score->student->id]) }}">Edit</a>
                            </li>
                            <li><a href="{{ route('singlestudent.grade.show', [$grade->slug,$score->student->id]) }}">Profile</a></li>
                          </ul>
                        </div>
                      </td>
                      <td class="col-md-2">{{ $score->student->gender }}</td>
                      <td class="col-md-2"> {{ $score->first_month }}</td>
                      <td class="col-md-2">{{ $score->second_month }}</td>
                      <td class="col-md-2"> {{ $score->third_month }}</td>
                    </tr>
                  @endforeach
                @else
                  @foreach($students as $student)
                    <tr>
                      <td class="col-md-3">{{ $student->name }}</td>
                      <td class="col-md-2">{{ $student->gender }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td style="position:absolute; width:55%; bottom:0; right:0.5em;">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="{{ route('exportscore.show',[$grade->slug, $subject])}}" class="alert-link">Download Spreed Sheet</a>
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
            <a href="{{ route('exportscore.show',[$grade->slug, $subject])}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('uploadscore.show',[$grade->slug, $subject])}}" class="btn btn-primary">Upload Worksheet <i class="fa fa-download"></i></a>
          </div>
        </div>
          <div class="panel-body">
            <table id="data_{{ $quarter->slug }}" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">Gender</th>
                    @foreach($quarter->months as $month)
                      <th class="col-md-2">{{ $month['name']}}</th>
                    @endforeach
                  </tr>
              </thead>
              <tbody style="position:relative;">
                @if(count($quarter->score))
                  @foreach($quarter->score as $score)
                    <tr class="record-row">
                      <td class="col-md-3">
                        <div class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{$score->student->name}} <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                              <a href="{{ route('score.show', [$grade->slug, $subject, $quarter->slug, $score->student->id]) }}">Edit</a>
                            </li>
                            <li><a href="{{ route('singlestudent.grade.show', [$grade->slug,$score->student->id]) }}">Profile</a></li>
                          </ul>
                        </div>
                      </td>
                      <td class="col-md-2">{{ $score->student->gender }}</td>
                      <td class="col-md-2"> {{ $score->first_month }}</td>
                      <td class="col-md-2">{{ $score->second_month }}</td>
                      <td class="col-md-2"> {{ $score->third_month }}</td>

                    </tr>
                  @endforeach
                @else
                  @foreach($students as $student)
                    <tr>
                      <td class="col-md-3">{{ $student->name }}</td>
                      <td class="col-md-2">{{ $student->gender }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td style="position:absolute; width:55%; bottom:0; right:0.5em;">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="{{ route('exportscore.show',[$grade->slug,$subject])}}" class="alert-link">Download Spreed Sheet</a>
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
