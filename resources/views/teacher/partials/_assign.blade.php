
<div class="row">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" style="margin-bottom:1em;">
			<li role="presentation" class="active"><a href="#classteacher" aria-controls="classteacher" role="tab" data-toggle="tab">Class Teacher</a></li>
			<li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">Teacher</a></li>
			<li role="presentation"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Administrator</a></li>
		</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="classteacher">
			@include('teacher.partials.subviews.class._show')
		</div>
		<div role="tabpanel" class="tab-pane" id="teacher">
			@include('teacher.partials.subviews.teacher._show')
		</div>
		<div role="tabpanel" class="tab-pane" id="admin">
			@include('teacher.partials.subviews.admin._show')
		</div>
	</div>
</div>
