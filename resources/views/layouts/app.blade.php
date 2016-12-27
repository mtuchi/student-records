<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gonzaga') }}</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <style media="screen">
      .profile-rollup-wrapper{
        border: 1px solid #ddd;
        cursor: pointer;
        margin: 1em 0;
        /*background: blue;*/
      }
      .py-4 {
        padding-top: 24px;
        padding-bottom: 44px;
      }
      .py-1 {
          padding-top: 4px;
          padding-bottom: 4px;
      }

      .pl-4 {
        padding-left: 24px;
      }
      .ml-3 {
          margin-left: 16px;
      }
      .ml-0 {
          margin-left: 0;
      }

      .mt-1 {
        margin-top: 4px;
      }
      .position-relative{
        position: relative;
      }
      .discussion-item-icon {
          position: absolute;
          float: left;
          width: 32px;
          height: 32px;
          margin-top: -7px;
          margin-left: -40px;
          line-height: 28px;
          color: #767676;
          text-align: center;
          background-color: #f3f3f3;
          border: 2px solid #fff;
          border-radius: 50%;
      }
      .no-underline {
          text-decoration: none;
      }
      .lh-condensed {
          line-height: 1.25;
      }

      .octicon {
          vertical-align: text-bottom;
      }
      .octicon {
          display: inline-block;
          vertical-align: text-top;
          fill: currentColor;
      }
      .f4 {
          font-size: 16px;
      }
      .muted-link {
          color: #767676;
      }

      .profile-rollup-content{
        padding: 2em 2em 0 0;
        display: block;
      }
      .profile-header{
        height: 32px;
        margin-top: -7px;
        line-height: 28px;
        font-size: 24px;
        padding-left: 0;
      }
      span.profile-rollup-toggle-open {
        display: none;
      }


      td.description .body .full, td.description .body .blurb.is-showing{
        display: none;
        -webkit-transition: display 2s; /* Safari */
        transition: display 2s;
        -moz-transition: display 2s;
      }

      td.description .body .full.is-showing{
        display: block;
        -webkit-transition: display 2s; /* Safari */
        transition: display 2s;
        -moz-transition: display 2s;
      }

      td.description .body .blurb{
        position: relative;
      }
      td.description .body .blurb{
        width: 400px;
        height: 24px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .activity-row{
        cursor: pointer;
        border-bottom: 1px solid #ddd;
      }
      .activity-row .type, .activity-row .action{
        position: relative;
        width: 15%;
      }
      .activity-row .created_at{
        position: relative;
        width: 20%;
      }
      .default-activity, .activity-row .action span,.activity-row .created_at div{
        position: absolute;
        top: 0;
        margin:1em 1em 0 0;
      }
      .subj-list li{
        padding: 1em 0;
      }
      .subj-list li:last-child{
        margin-bottom: 1em;
      }
      .border-top{
        border-top: 1px solid #ddd;
      }
      .border-bottom {
        border-bottom: 1px solid #ddd;
      }
      .card-details{
        padding: .25em 0;
      }
      .card-detail{
        margin: .5em 0;
      }
      .border-gray-dark{
        border: 1px solid #ddd;
      }
      .pinned-subjs-list{
        position: relative;
        list-style: none;
        padding-left: 1em;
      }
      .pinned-subj-desc{
        /*background: red;*/
      }

      .teacher-name{
        position: absolute;
        bottom: 1em;
        left: 1em;
      }
      .profile-timeline-card{
        padding: 1em;
      }
      .profile-timeline-card-wrapper{
        margin-left: -1em;
        margin-right: 1em;
      }
      .overviews-setting{
        /*background: red;*/
        width: auto;
      }
      .profile-timeline.discussion-timeline{
        position: relative;
      }

      .overviews-setting .dropdown{
        display: inline-block;
      }
      .subj-filter{
        position: relative;
      }
      .pinned-subj-item {
        padding: 1em;
        margin:1em 4.5em 1em 0;
        height: 200px;
      }
      .record-row{
        position: relative;
        cursor: pointer;
      }

      .custom-position{
        position: fixed;
        top: 10px;
        left: 0;
        right: 0;
        margin: 0 auto;
        z-index: 1040;
        box-sizing: border-box;
        width: 350px;
      }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

  <div id="app">
    @include('layouts.partials._navigations')
    @include('layouts.partials.notify')
    @yield('content')
  </div>


  <!-- Scripts -->
  <script src="{{ asset('/js/app.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      window.setTimeout(function() {
          $(".alert-message").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, {{ notify()->option('timer') ? notify()->option('timer') : 2000 }});

      /*
        Bootstrap 3: Keep selected tab on page refresh
        source:http://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
      */
			$('#myTab a').click(function(e) {
			  e.preventDefault();
			  $(this).tab('show');
			});

			// store the currently selected tab in the hash value
			$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
			  var id = $(e.target).attr("href").substr(1);
			  window.location.hash = id;
			});

			$("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
			  var id = $(e.target).attr("href").substr(1);
			  window.location.hash = id;
			});

			// on load of the page: switch to the currently selected tab
			var hash = window.location.hash;
			$('#myTab a[href="' + hash + '"]').tab('show');

      $('#export-tabmenu a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
      });

      // store the currently selected tab in the hash value
      $("ul#export-tabmenu > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
      });

      // on load of the page: switch to the currently selected tab
      var hash = window.location.hash;
      $('#export-tabmenu a[href="' + hash + '"]').tab('show');

      // Duplicate of above solution for quarter tabs
      $('#quarter-tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
      });

      // store the currently selected tab in the hash value
      $("ul#quarter-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
      });

      // on load of the page: switch to the currently selected tab
      var hash = window.location.hash;
      $('#quarter-tabs a[href="' + hash + '"]').tab('show');

      // Dropdown issues #quick fix
      $('.dropdown-checkbox').prop('checked',false);

      // Re implimeting the collapse for activity logs
      $('.activity-row').click(function(){
        $(this).children('td.description').children('.body').children('.full').toggleClass('is-showing');
        $(this).children('td.description').children('.body').children('.blurb').toggleClass('is-showing');
      });

      $('.profile-rollup-wrapper').click(function(){
        $(this).children('ul.profile-rollup-content').toggleClass('hidden');
        $(this).children('span.profile-header').children('span.toggle-icon').children('.profile-rollup-toggle-open').toggleClass('show');
        $(this).children('span.profile-header').children('span.toggle-icon').children('.profile-rollup-toggle-closed').toggleClass('hidden');
      });

      // tooltip
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

    });

  </script>
</body>
</html>
