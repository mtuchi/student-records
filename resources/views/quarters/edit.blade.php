@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit {{ $score->quarter->name }} Scores
          <div class="pull-right" style="margin-top:-7.5px;">
            <a href="{{route('go.back',$subject->slug)}}" class="btn btn-default">Go Back</a>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{ route('post.edit',[$subject->slug,$score->quarter->slug,$score->student_id])}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
              <label class="col-sm-2 control-label">Student Name</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{ $score->student->name }}</p>
              </div>
            </div>
            <div class="form-group{{ $errors->has('first_month_score') ? ' has-error' : '' }}">
              <label for="first_month_score" class="col-sm-2 control-label">First Month</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="first_month_score" name="first_month_score" placeholder="First Month" value="{{ $score->first_month or old('first_month_score') }}" required autofocus>
                @if ($errors->has('first_month_score'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_month_score') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('second_month_score') ? ' has-error' : '' }}">
              <label for="second_month_score" class="col-sm-2 control-label">Second Month</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="second_month_score" name="second_month_score" placeholder="Second Month" value="{{ $score->second_month or old('second_month_score') }}" required>
                @if ($errors->has('second_month_score'))
                    <span class="help-block">
                        <strong>{{ $errors->first('second_month_score') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('third_month_score') ? ' has-error' : '' }}">
              <label for="third_month_score" class="col-sm-2 control-label">Third Month</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="third_month_score" name="third_month_score" placeholder="Third Month" value="{{ $score->third_month or old('third_month_score') }}" required>
                @if ($errors->has('third_month_score'))
                    <span class="help-block">
                        <strong>{{ $errors->first('third_month_score') }}</strong>
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
