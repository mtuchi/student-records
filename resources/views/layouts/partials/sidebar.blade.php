@if(Auth::user()->hasRole('admin'))
	<div class="panel panel-default">
		<div class="panel-heading">
			School Management Section
		</div>
		<div class="panel-body">
			<div class="boxed-group-inner">
				<ul class="mini-class-list js-class-list">
					<li><a href="{{ url('/teachers') }}">Teachers</a></li>
					<li><a href="{{ url('/students') }}">Students</a></li>
					<li><a href="{{ url('/grades')}}">Grades</a></li>
					<li class="hidden"><a href="">Subjects</a></li>
				</ul>
			</div>
		</div>
	</div>
@endif

@if(Auth::user()->hasRole('teacher'))
  <div class="panel panel-default">
    <div class="panel-heading">Teacher Sections</div>
    <div class="panel-body">
      <div class="boxed-group-inner">
        Class Assigned with subject
        <ul class="mini-class-list js-class-list">
          @foreach($teachers as $teacher)
						<li><a href="{{ route('score.quarter',[$teacher->grade[0]->slug,$teacher->subject->name]) }}">{{ $teacher->subject->name }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  @endif

  @if(Auth::user()->hasRole('class_teacher'))
  <div class="panel with-nav-tabs panel-default">
	  <div class="tabbable-panel">
		  <div class="tabbable-line">
			  <ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#class_section" data-toggle="tab">Class Section</a></li>
				  <li><a href="#teachers" data-toggle="tab">Teachers</a></li>
			  </ul>
			  <div class="tab-content">
				  <div class="tab-pane active" id="class_section">
					  <div class="boxed-group-inner">
	            <ul class="mini-class-list js-class-list">
	  			 			{{ $grade->slug }} profile
	              <li><a href="{{ route('grade.show',$grade->slug) }}">{{ $grade->slug }}</a></li>
				  			Class Attendance
				  			<li><a href="{{ route('attendance.quarter',$grade->slug) }}">Attendance for {{ $grade->slug }}</a></li>
	            </ul>
	          </div>
				  </div>
				  <div class="tab-pane" id="teachers">
					  <div class="boxed-group-inner">
	            Teachers with their assaigned subjects
	            <ul class="mini-class-list js-class-list">
	              @foreach($grade->teacher as $teacher)
			  				<li class="">
									<span class="octicon octicon-repo"></span>
									<img src="/build/svg/repo.svg"></img>
			  					<span class="author" itemprop="author">
			  						@if ($teacher->user)
			  							<a href="#" class="url link" rel="author">{{ $teacher->user->username }}</a>
			  							@else
			  							<span class="badge" title="No Assigned Subject Teacher Yet!" data-toggle="tooltip" data-placement="top">N A</span>
			  						@endif
			  					</span>
			  					<span class="path-divider">/</span>
			  					<strong>
			  						@if ($teacher->subject)
			  							<a href="#">{{ $teacher->subject->name }} </a>
			  							@else
			  							<span class="badge" title="No Assigned Subject Yet!" data-toggle="tooltip" data-placement="top">N A</span>
			  						@endif
			  					</strong>
			  				</li>
	              @endforeach
	            </ul>
			      </div>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>
  @endif
