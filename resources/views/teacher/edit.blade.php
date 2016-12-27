@extends('home')

@section('main.content')
<div class="container">
  <div class="row">
      <div class="col-md-8 row">
				<div class="col-md-3">
				  <!-- Nav tabs -->
				  <ul class="nav nav-pills nav-stacked" id="myTab" role="tablist">
						<li role="presentation" class="active"><a href="#assign" aria-controls="assign" role="tab" data-toggle="tab">Assign Role</a></li>
				    <li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a></li>
				    <li role="presentation"><a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Delete</a></li>
				  </ul>
				</div>
				<!-- Tab panes -->
			  <div class="tab-content col-md-9">
					<div role="tabpanel" class="tab-pane active" id="assign">
						@include('teacher.partials._assign')
					</div>
			    <div role="tabpanel" class="tab-pane" id="edit">
            @include('teacher.partials._update')
					</div>
			    <div role="tabpanel" class="tab-pane" id="delete">
            @include('teacher.partials._delete')
          </div>
			  </div>
      </div>
  </div>
</div>
@endsection
