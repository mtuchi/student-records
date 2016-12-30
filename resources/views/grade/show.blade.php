@extends('home')

@section('main.content')
<div class="container">
  <div class="row">
      <div class="col-md-8 row">
				<div class="col-md-3">
				  <!-- Nav tabs -->
				  <ul class="nav nav-pills nav-stacked" id="myTab" role="tablist">
						<li role="presentation" class="active"><a href="#subjects" aria-controls="subjects" role="tab" data-toggle="tab">Subjects</a></li>
				    <li role="presentation"><a href="#students" aria-controls="students" role="tab" data-toggle="tab">Students</a></li>
				  </ul>
				</div>
				<!-- Tab panes -->
			  <div class="tab-content col-md-9">
					<div role="tabpanel" class="tab-pane active" id="subjects">
						@include('grade.partials._subjects')
					</div>
			    <div role="tabpanel" class="tab-pane" id="students">
						@include('grade.partials._students')
					</div>
			  </div>
      </div>
  </div>
</div>
@endsection
