@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Attendance Sheet
                  <div class="pull-right" style="margin-top:-7.5px;">
                    <a href="{{route('grade.back',$grade)}}" class="btn btn-default">Go Back</a>
                  </div>
                </div>
                <div class="panel-body">
                <form class="form-horizontal" action="{{ route('uploadattendance.store',$grade) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <div class="col-md-12 container">
                        <p class="alert alert-warning" role="alert"> Please make sure you have latest entry result For {{ $grade}}
                        </p>
                        <input class="form-control" type="file" name="sheet" id="sheet" required autofocus>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-8">
                          <button class="btn btn-success" type="submit">
                              Upload attendance
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
