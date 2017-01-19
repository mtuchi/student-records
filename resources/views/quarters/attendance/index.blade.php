@extends('home')

@section('main.content')

<div class="panel" style="padding-left:1em;">
  <div class="row">
    <h4 class="col-xs-12 col-sm-8 col-md-8">
      <span class="octicon octicon-repo"></span>
      <img src="/build/svg/repo.svg"></img>
      <span class="author" itemprop="author">
        Attendance for
      </span>
      <span class="path-divider">@</span>
      <strong>
      <a href="#">{{ $grade }}</a>
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
            <a href="{{ route('exportattendance.show',$grade)}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('uploadattendance.show',$grade)}}" class="btn btn-primary">Upload Worksheet <i class="fa fa-download"></i></a>

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
                @if(count($quarter->attendance))
                  @foreach($quarter->attendance as $attendance)
                    <tr class="record-row">
                      <td class="col-md-3">
                        <div class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $attendance->student->name }} <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                              <a href="{{ route('attendance.show', [$grade,$quarter->slug,$attendance->student_id])}}">Edit</a>
                            </li>
                            <li><a href="{{ route('student.grade.show', [$grade,$attendance->student_id]) }}">Profile</a></li>
                          </ul>
                        </div>
                      </td>
                      <td class="col-md-2">{{ $attendance->student->gender }}</td>
                      <td class="col-md-2">{{ $attendance->first_month }}</td>
                      <td class="col-md-2">{{ $attendance->second_month }}</td>
                      <td class="col-md-2">{{ $attendance->third_month }}</td>

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
                    <td style="position:absolute; width:55%; bottom:0; top:0;right:0.5em;">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="#" class="alert-link">Download Spreed Sheet</a>
                            to fill student attendance
                          </div>
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
            <a href="{{ route('exportattendance.show',$grade)}}" class="btn btn-success">Download Sheet</a>
            <a href="{{ route('uploadattendance.show',$grade)}}" class="btn btn-primary">Upload Worksheet <i class="fa fa-download"></i></a>
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
                @if(count($quarter->attendance))
                  @foreach($quarter->attendance as $attendance)
                    <tr class="record-row">
                      <td class="col-md-3">
                        <div class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $attendance->student->name }} <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                              <a href="{{ route('attendance.show', [$grade,$quarter->slug,$attendance->student_id])}}">Edit</a>
                            </li>
                            <li><a href="{{ route('student.grade.show', [$grade,$attendance->student_id]) }}">Profile</a></li>
                          </ul>
                        </div>
                      </td>
                      <td class="col-md-2">{{ $attendance->student->gender }}</td>
                      <td class="col-md-2">{{ $attendance->first_month }}</td>
                      <td class="col-md-2">{{ $attendance->second_month }}</td>
                      <td class="col-md-2">{{ $attendance->third_month }}</td>
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
                    <td style="position:absolute; width:55%; bottom:0; top:0;right:0.5em;">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="alert alert-info" role="alert">
                            Heads up! <a href="#" class="alert-link">Download Spreed Sheet</a>
                            to fill student attendance
                          </div>
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
