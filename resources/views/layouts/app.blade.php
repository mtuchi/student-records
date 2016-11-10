<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('/bower_components/dropdown/dropdowns-enhancement.css') }}" rel="stylesheet"> --}}
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
    {{-- <script src="{{ asset('/bower_components/datatables.net.bs/js/jquery.dataTables.js')}}"></script> --}}
    <script type="text/javascript">
      $(document).ready(function() {
        // $('#data_first_quarter').DataTable();
        // $('#data_second_quarter').DataTable();
        // $('#data_third_quarter').DataTable();
        // $('#data_fourth_quarter').DataTable();
      } );
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

      $('.export-form').submit(function(e){
        e.preventDefault();
          var url = window.location.pathname,
             hash = window.location.hash.replace('#', '/'),
         formdata = $(this).serializeArray();

          $.ajax({
            type        :   'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         :   url.concat(hash), // the url where we want to POST
            data        :   formdata, // our data object
            dataType    :   'json', // what type of data do we expect back from the server
            encode      :   true,
            success     :   function(data){

                if (data['request_status'] )
                {
                    //Do success notification here
                    console.log('response:'+data['request_status']);
                } else {
                        // Do errors here
                        console.log(data);
                    }
            },
            error: function(response){
              var obj = jQuery.parseJSON(response.responseText);
              console.log(response.responseText);

              $('#incase-has-errors').addClass('has-error');
              $('#incase-errors').show({duration: 0, queue: true}).delay(2000).hide({duration: 0, queue: true});
              $('#incase-errors strong').text(obj.quarters);
              $('#incase-errors-months').show({duration: 0, queue: true}).delay(2000).hide({duration: 0, queue: true});
              $('#incase-errors-months strong').text(obj.months);
            }
          });
      });


    </script>
</body>
</html>
