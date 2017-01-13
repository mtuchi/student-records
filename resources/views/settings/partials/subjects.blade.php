<div class="subj-list list-unstyled" data-filterable-for="your-subjs-filter" data-filterable-type="substring">
  @if ($teachers)
    @foreach($teachers as $teacher)
      <li class="col-md-12 show border-bottom">
        <div class="d-inline-block mb-1">
          <h3>
            <a href="#">{{ $teacher->Subject->name }}</a>
          </h3>

            <span class="f6 text-gray mb-1">
              subject assaigned by <a href="#" class="muted-link"> Academic Head</a>
            </span>
        </div>

        <div class="py-1">
          @if($teacher->subject->description)
          <p class="col-9 d-inline-block text-gray m-0 pr-4" itemprop="description">
            {{ $teacher->subject->description }}
          </p>
          @else
          <p class="col-9 d-inline-block text-gray m-0 pr-4" itemprop="description">
            <blockquote class="h5">
              Subject description is not set
              Please add subject description
              <a href="#">subject description</a>
            </blockquote>
          </p>
          @endif

        </div>

        <div class="f6 text-gray mt-2">
            <span class="subj-language-color ml-0" style="background-color:#4F5D95;"></span>
            <span class="mr-3">
              {{ $teacher->teacher->name }}
            </span>

            Updated <relative-time datetime="2016-09-14T23:49:25Z" title="15 Sep 2016 02:49 GMT +3">{{ $teacher->teacher->updated_at->diffForHumans() }}</relative-time>
        </div>
      </li>
    @endforeach
  @else
    <div class="alert well">
      No Teacher Data Found!
    </div>
  @endif

</div>
