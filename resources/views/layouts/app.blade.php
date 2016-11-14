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
      .record-row{
        position: relative;
        cursor: pointer;
      }
      .actions{
        position: absolute;
        right: 0;
        display: none;
      }
      .record-row:hover .actions{
        display: block;
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

    });


  </script>
</body>
</html>
