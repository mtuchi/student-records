<div class="panel panel-default">
  @if(Auth::user()->hasRole('teacher'))
    <div class="panel-heading">Teacher Sections</div>
    <div class="panel-body">
      <div class="boxed-group-inner">
        Class Assigned with subject
        <ul class="mini-class-list js-class-list">
          @foreach($subjects as $subject)
            <li><a href="{{ route('user.subject',$subject->slug ) }}">{{ $subject->name }} {{ $subject->class }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
  @if(Auth::user()->hasRole('class_teacher'))
    <div class="panel-heading">Class Teacher Sections</div>
    <div class="panel-body">
      <div class="boxed-group-inner">
        Class Assigned with subject
        <ul class="mini-class-list js-class-list">
          @foreach($subjects as $subject)
            <li><a href="{{ route('user.subject',$subject->slug ) }}">{{ $subject->name }} {{ $subject->class }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
</div>
