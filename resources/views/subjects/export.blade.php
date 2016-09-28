@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Download Score Sheet
                  <div class="pull-right" style="margin-top:-7.5px;">
                    <a href="{{route('go.back',$subject->slug)}}" class="btn btn-default">Go Back</a>
                  </div>
                </div>
                <div class="panel-body">
                <form class="form-horizontal" action="{{ route('post.export',$subject->slug) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <div class="col-md-12 container">
                        <p class="alert alert-success" role="alert"> You will get latest entry result for {{$subject->name}}. </p>
                        <p class="alert alert-warning hidden" role="alert">This is the warning if something went wrong</p>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-8">
                          <button class="btn btn-success" type="submit">
                              Download scores
                          </button>
                      </div>
                  </div>
              </form>
    				</div>
        </div>
    </div>
</div>
@endsection
