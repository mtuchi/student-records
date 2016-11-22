<div id="js-overview-activity" class="activity-listing overview-activity">
  @if($overviewActivities->count())
    @foreach($overviewActivities as $activity)
      <div class="overview-activity-listing col-md-12 pull-left">
        <div class="profile-timeline discussion-timeline width-full">
          <h3 class="profile-timeline-month-heading bg-white d-inline-block h6">
            {{ $activity->created_at->diffForHumans() }}
          </h3>

          <div class="profile-timeline-card-wrapper">
            <div class="profile-timeline-card bg-white border border-gray-dark">
              <svg aria-hidden="true" class="octicon octicon-flame text-green mr-1" height="16" version="1.1" viewBox="0 0 12 16" width="12">
                <path fill-rule="evenodd" d="M5.05.31c.81 2.17.41 3.38-.52 4.31C3.55 5.67 1.98 6.45.9 7.98c-1.45 2.05-1.7
                 6.53 3.53 7.7-2.2-1.16-2.67-4.52-.3-6.61-.61 2.03.53 3.33 1.94 2.86 1.39-.47 2.3.53 2.27 1.67-.02.78-.31 1.44-1.13 1.81
                 3.42-.59 4.78-3.42 4.78-5.56 0-2.84-2.53-3.22-1.25-5.61-1.52.13-2.03 1.13-1.89 2.75.09 1.08-1.02 1.8-1.86 1.33-.67-.41-.66-1.19-.06-
                 1.78C8.18 5.31 8.68 2.45 5.05.32L5.03.3l.02.01z"></path></svg><br/>
                @if($activity->description)
                <span class="f6 text-{{ $activity->getExtraProperty('type')}}">
                  {{ $activity->description }}
                </span>
                @else
                <span class="f6 text-muted">
                  No subject found for this activity log.
                </span>
                @endif

                @if($activity->changes->count())
                  <blockquote class="h5">
                    <h3 class="h4">
                      <a href="" class="text-gray-dark">{{ $activity->causer->name }} updated</a>
                    </h3>
                    <p>
                      from
                      <code> {{ $activity->changes['old']['first_month'] }}</code>
                      <code> {{ $activity->changes['old']['second_month'] }}</code>
                      <code> {{ $activity->changes['old']['third_month'] }}</code>
                      to
                      <code>{{ $activity->changes['attributes']['first_month'] }}</code>
                      <code> {{ $activity->changes['attributes']['second_month'] }}</code>
                      <code> {{ $activity->changes['attributes']['third_month'] }}</code>
                    </p>
                  </blockquote>

                @else
                  <blockquote class="h5">
                    <h3 class="h4">
                      <a href="" class="text-gray-dark">{{ $activity->causer->name }} <strong class="text-info">{{ $activity->getExtraProperty('description') }} updated</strong></a>
                    </h3>
                    <p class="text-warning">
                      Opps! Changelog was not processed.!
                    </p>
                  </blockquote>
                @endif

            </div>
          </div>
        </div>
      </div>
    @endforeach
  @else
  <div class="overview-activity-listing col-md-12 pull-left">
    <div class="profile-timeline discussion-timeline width-full pb-4">
      <h3 class="profile-timeline-month-heading bg-white d-inline-block h6 pr-2 py-1">
          November <span class="text-gray">2016</span>
      </h3>
      <div class="text-center text-gray pt-3">
        <span class="text-gray m-0">
            mtuchi has no activity yet for this period.
        </span>
      </div>
    </div>
  </div>
  @endif

  <form accept-charset="UTF-8" action="" class="col-md-12 js-show-more-timeline-form" style="margin:1em 1em 2em -1em;">
    <div style="margin:0;padding:0;display:inline"><input name="utf8" value="✓" type="hidden"></div>
      <button type="submit" class="btn btn-default border-gray-dark col-md-12 overview-activity-show-more">
        Show more activity
      </button>
      <p class="text-muted text-center" style="margin:1em 0;">
        Seeing something unexpected? Take a look at the
        <a href="#">Gonzaga profile guide</a>.
      </p>
  </form>
</div>
