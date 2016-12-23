@if(Auth::user()->hasRole('admin'))
	<div class="panel panel-default">
		<div class="panel-heading">
			School Management Section
		</div>
		<div class="panel-body">
			<div class="boxed-group-inner">
				<ul class="mini-class-list js-class-list">
					<li><a href="{{ url('/teacherlist') }}">Teachers</a></li>
					<li><a href="{{ url('/students') }}">Students</a></li>
					<li><a href="">Grades</a></li>
					<li><a href="">Subjects</a></li>
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
          @foreach($subjects as $subject)
            @foreach($subject->grade as $grade)
              <li><a href="{{ route('quarter.show',[$grade->slug,$subject->subject->name]) }}">{{$subject->subject->name}}</a></li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  @endif

  @if(Auth::user()->hasRole('class_teacher'))
    <div class="panel panel-default">
      <div class="panel-heading">Class Attendance Sections</div>
      <div class="panel-body">
        <div class="boxed-group-inner">
          Class Attendance for
          <ul class="mini-class-list js-class-list">
            <li><a href="{{ route('grade.show',$getgrade->slug) }}">{{ $getgrade->name }}</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">@ {{ $getgrade->name  }} Class, Teachers List</div>
      <div class="panel-body">
        <div class="boxed-group-inner">
          Teachers with their assaigned subjects
          <ul class="mini-class-list js-class-list">
            @foreach($teachers as $teacher)
              <li class="col-xs-12 col-sm-8 col-md-12">
                <svg aria-hidden="true" class="octicon octicon-repo" height="16" version="1.1" viewBox="0 0 12 16" width="12">
                <path d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>
                <span class="author" itemprop="author">
                <a href="#" class="url link" rel="author">{{$teacher->teacher->username}}</a>
                </span>
                <span class="path-divider">/</span>
                <strong>
                <a href="#">{{ $teacher->subject->name }} </a>
                </strong>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif
