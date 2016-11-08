<template lang="html">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
                Export Scores,
            </div>
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked" role="tablist" id="export-tabmenu">
                <li role="presentation" class="active">
                  <a href="#all" role="tab" data-toggle="tab" id="all-tab" aria-controls="all" aria-expanded="false">All</a>
                </li>
                <li role="presentation">
                  <a href="#quarter" role="tab" data-toggle="tab" id="quarter-tab" aria-controls="quarter" aria-expanded="false">By Quarter</a>
                </li>
                <li role="presentation">
                  <a href="#month" role="tab" data-toggle="tab" id="month-tab" aria-controls="month" aria-expanded="false">By Month</a>
                </li>
              </ul>
            </div>
          </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
          <div class="tab-content" id="export-tabcontent">
            <div class="tab-pane fade active in" role="tabpanel" id="all" aria-labelledby="all-tab">
              <div class="panel panel-default">
                <div class="panel-heading">Download Score Sheet
                  <div class="pull-right" style="margin-top:-7.5px;">
                    <a href="" class="btn btn-default">Go Back</a>
                  </div>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" action="" method="post" >

                    <div class="form-group">
                        <div class="col-md-12 container">
                          <!-- <p class="alert alert-success hidden" role="alert"> You will get latest entry result for <b>{{ $subject->subject->name }}</b>.</p>
                          <p class="alert alert-info" role="alert">This is option will export all students
                             <b> {{ $subject->subject->name }} </b> scores for <b>{{ $grade->slug }}</b> </p> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button class="btn btn-default" type="submit">
                                Download scores
                            </button>
                        </div>
                    </div>
                </form>
      				</div>
            </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="quarter" aria-labelledby="quarter-tab">
              <div class="panel panel-default">
                <div class="panel-heading">Export by quarter
                  <div class="pull-right" style="margin-top:-7.5px;">
                    <a href="" class="btn btn-default">Go Back</a>
                  </div>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" action="" method="post">

                    <div class="form-group">
                        <div class="col-md-12 container">
                          <p class="alert alert-info" role="alert">
                            This is option will export students
                            <!-- <b> {{ $subject->subject->name }} </b> -->
                             <!-- scores for <b>{{ $grade->slug }}</b> -->
                            By select quarter you wish to edit.
                          </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="quarter-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Select Quarter
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="quarter-dropdownMenu">
                              <li class="dropdown-header">Quarter</li>
                              <li>
                                <input id="first" name="quarters[]" value="1" type="checkbox" class="dropdown-checkbox">
                                <label for="first">First</label>
                              </li>
                              <li>
                                <input id="second" name="quarters[]" value="2" type="checkbox" class="dropdown-checkbox">
                                <label for="second">Second</label>
                              </li>
                              <li>
                                <input id="third" name="quarters[]" value="3" type="checkbox" class="dropdown-checkbox">
                                <label for="third">Third</label>
                              </li>
                              <li>
                                <input id="fourth" name="quarters[]" value="4" type="checkbox" class="dropdown-checkbox">
                                <label for="fourth">Fourth</label>
                              </li>
                            </ul>
                            <!-- @if ($errors->has('quarters'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quarters') }}</strong>
                                </span>
                            @endif -->
                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button class="btn btn-default" type="submit">
                                Download scores
                            </button>
                        </div>
                    </div>
                  </form>
        				</div>
              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="month" aria-labelledby="month-tab">
              <div class="panel panel-default">
                <div class="panel-heading">Export by month
                  <div class="pull-right" style="margin-top:-7.5px;">
                    <a href="" class="btn btn-default">Go Back</a>
                  </div>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" action="" method="post" >

                    <div class="form-group">
                        <div class="col-md-12 container">
                          <p class="alert alert-info" role="alert">
                            This is option will export students
                            <!-- <b> {{ $subject->subject->name }} </b> scores for <b>{{ $grade->slug }}</b> -->
                            By select month you wish to edit.
                          </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="month-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Select Month
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="month-dropdownMenu">
                              <li>
                                <input id="jan" name="months[]" value="[1,1]" type="checkbox" class="dropdown-checkbox">
                                <label for="jan">January</label>
                              </li>
                              <li>
                                <input id="feb" name="months[]" value="[1,2]" type="checkbox" class="dropdown-checkbox">
                                <label for="feb">February</label>
                              </li>
                              <li>
                                <input id="mar" name="months[]" value="[1,3]" type="checkbox" class="dropdown-checkbox">
                                <label for="mar">March</label>
                              </li>
                              <li>
                                <input id="april" name="months[]" value="[2,4]" type="checkbox" class="dropdown-checkbox">
                                <label for="april">April</label>
                              </li>
                              <li>
                                <input id="may" name="months[]" value="[2,5]" type="checkbox" class="dropdown-checkbox">
                                <label for="may">May</label>
                              </li>
                              <li>
                                <input id="june" name="months[]" value="[2,6]" type="checkbox" class="dropdown-checkbox">
                                <label for="june">June</label>
                              </li>
                              <li>
                                <input id="july" name="months[]" value="[3,7]" type="checkbox" class="dropdown-checkbox">
                                <label for="july">July</label>
                              </li>
                              <li>
                                <input id="aug" name="months[]" value="[3,8]" type="checkbox" class="dropdown-checkbox">
                                <label for="aug">August</label>
                              </li>
                              <li>
                                <input id="sept" name="months[]" value="[3,9]" type="checkbox" class="dropdown-checkbox">
                                <label for="sept">September</label>
                              </li>
                              <li>
                                <input id="oct" name="months[]" value="[4,10]" type="checkbox" class="dropdown-checkbox">
                                <label for="oct">October</label>
                              </li>
                              <li>
                                <input id="nov" name="months[]" value="[4,11]" type="checkbox" class="dropdown-checkbox">
                                <label for="nov">November</label>
                              </li>
                              <li>
                                <input id="dec" name="months[]" value="[4,12]" type="checkbox" class="dropdown-checkbox">
                                <label for="dec">December</label>
                              </li>
                            </ul>
                            <!-- @if ($errors->has('months'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('months') }}</strong>
                                </span>
                            @endif -->
                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button class="btn btn-default " type="submit">
                                Download scores
                            </button>
                        </div>
                    </div>
                  </form>
        				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
    };
  },
  computed: {},
  ready() {},
  attached() {},
  methods: {},
  components: {}
};
</script>

<style lang="css">
</style>
