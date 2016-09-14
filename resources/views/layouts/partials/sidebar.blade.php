<div class="panel panel-default">
    <div class="panel-heading">Sections</div>
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
</div>
