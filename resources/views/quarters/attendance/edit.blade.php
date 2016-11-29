@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">Edit {{ $attendance->name }} Attendance
          <div class="pull-right" style="margin-top:-7.5px;">
            <a href="{{route('grade.back',[$grade])}}" class="btn btn-default">Go Back</a>
          </div>
        </div>
        <div class="panel-body">
          @foreach ($attendance->attendance as $value)
            <form class="form-horizontal" action="{{ route('attendance.update',[$grade,$attendance->slug,$value->student_id])}}" method="post">
              {{ csrf_field() }}

              <div class="form-group">
                <label class="col-sm-2 control-label">Student Name</label>
                <div class="col-sm-10">
                  <p class="form-control-static">{{ $value->student->name }}</p>
                </div>
              </div>
              <div class="form-group{{ $errors->has('first_month') ? ' has-error' : '' }}">
                <label for="first_month" class="col-sm-2 control-label">{{ $attendance->months[0]->name }}</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="first_month" name="first_month" placeholder="{{ $attendance->months[0]->name }}" value="{{ $value->first_month or old('first_month') }}" required autofocus>
                  @if ($errors->has('first_month'))
                      <span class="help-block">
                          <strong>{{ $errors->first('first_month') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('second_month') ? ' has-error' : '' }}">
                <label for="second_month" class="col-sm-2 control-label">{{ $attendance->months[1]->name }}</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="second_month" name="second_month" placeholder="{{ $attendance->months[1]->name }}" value="{{ $value->second_month or old('second_month') }}" required>
                  @if ($errors->has('second_month'))
                      <span class="help-block">
                          <strong>{{ $errors->first('second_month') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('third_month') ? ' has-error' : '' }}">
                <label for="third_month" class="col-sm-2 control-label">{{ $attendance->months[2]->name }}</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="third_month" name="third_month" placeholder="{{ $attendance->months[2]->name }}" value="{{ $value->third_month or old('third_month') }}" required>
                  @if ($errors->has('third_month'))
                      <span class="help-block">
                          <strong>{{ $errors->first('third_month') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                <label for="third_month" class="col-sm-2 control-label">Remarks</label>
                <div class="col-sm-10">
                  <textarea name="comments" class="form-control" rows="3" placeholder="Add remarks" value="{{ $attendance->comments or old('comments') }}"></textarea>
                  @if ($errors->has('comments'))
                      <span class="help-block">
                          <strong>{{ $errors->first('comments') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                      <button type="submit" class="btn btn-primary btn-block">
                          Submit
                      </button>
                  </div>
              </div>
            </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
