@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Score Sheet</div>
                <div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/records') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control" type="file" name="sheet" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button class="btn btn-success" type="submit">
                                    Upload scores
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
        </div>
    </div>
</div>
@endsection
