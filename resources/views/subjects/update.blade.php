<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<h5 class="col-md-8 text-left text-capitalize text-muted">Edit subject Records</h5>
			<div class="col-md-4">
				<div class="btn-group pull-right" role="group">
					{{-- <a href="#" class="btn btn-primary btn-sm hidden">Use Excel</a> --}}
					<a href="{{ url('/subjects') }}" class="btn btn-default btn-sm">Go Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('subjects.update',[$id])}}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Name</label>
				<div class="col-md-6">
					<input id="name" type="text" class="form-control" name="name" value="{{ $subject->name ? $subject->name : old('name')  }}" autofocus>
					@if ($errors->has('name'))
							<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
							</span>
					@endif
				</div>
			</div>

			<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
									Save Records
							</button>
					</div>
			</div>
		</form>
	</div>
</div>
