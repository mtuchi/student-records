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
      .profile-timeline-month-heading{ }
      .overviews-setting .dropdown{
        display: inline-block;
      }
      .subj-filter{
        position: relative;
      }
      .pinned-subj-item {
        /*background: grey;        */
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
    });


  </script>
</body>
</html>
