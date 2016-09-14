@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Dashboard</div>
	                <div class="panel-body">
		                  First Quater
						  <div class="row">
							  <div class="dropdown col-md-4">
							  	<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  	Dropdown trigger
							  	<span class="caret"></span>
							  	</button>
							  	<ul class="dropdown-menu" aria-labelledby="dLabel">
							  		<li><a href="#">First Quater</a></li>
							  		<li><a href="#">Second Quater</a></li>
							  		<li><a href="#">Third Quater</a></li>
							  		<li><a href="#">Fourth Quater</a></li>
							  	</ul>
							  </div>
							  <div class="btn-group col-md-3 pull-right">
							  	<button type="button" name="button" class="btn btn-success">Download Schema</button>
							  </div>
						  </div>

		            </div>
		        </div>
			</div>
		</div>
	</div>
@endsection
