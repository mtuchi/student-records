<div class="aurora-body">
  <div class="row">
    <div class="col-sm-6 columns">
      <h1 class="u-floatLeft u-mb-0 heading">Activity Logs</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <table class="activity-listing">
          <thead>
            <tr>
              <th id="ember1425" class="type"><span class="headerText">Type</span></th>
              <th id="ember1426" class="description"><span class="headerText">Description</span></th>
              <th id="ember1427" class="created_at"><span class="headerText">Date</span></th>
              <th id="ember1428" class="action"><span class="headerText"></span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($activities as $activity)
              <tr class="activity-row acknowledged" id="activity-47276915" data-toggle="description" data-target="#descriptionId" aria-expanded="false" aria-controls="descripitionId">
                <td class="type">
                  <div class="text-{{ $activity->getExtraProperty('type') ? $activity->getExtraProperty('type') : 'muted' }} default-activity">
                    {{ $activity->getExtraProperty('description') ? $activity->getExtraProperty('description') : 'Default' }}
                  </div>
                </td>
                <td class="description">
                  <p class="u-mb-0"><div id="ember1519" class="ellipsis-text">{{ $activity->causer->name }}</div></p>
                  <div class="body">
                    <div class="full">
                    <p>{{ $activity->description }}</p>

                    </div>
                    <div class="blurb">
                      {{ $activity->description }}
                    </div>
                  </div>
                </td>
                <td class="created_at">
                  <div id="ember1520" data-placement="top" data-toggle="tooltip" title=""
                  class=" tooltip-wrap" data-original-title="Wed, Sep 14, 2016 at 8:08 pm">
                  <time datetime="2016-09-14T17:08:09.000Z">{{ $activity->created_at->diffForHumans() }}</time>
                  </div>
                </td>
                <td class="action">
                  <span>Show<span class="Icon--arrowDown"></span></span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <nav aria-label="" class="hidden">
          <ul class="pager">
            <li class="disabled"><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </nav>
    </div>
  </div>

</div>
