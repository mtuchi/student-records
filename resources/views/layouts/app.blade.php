<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Gonzaga') }}</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<!-- Scripts -->
		<script>
				window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]);?>
		</script>

</head>
<body>

  <div id="app">
    @include('layouts.partials._navigations')
    @include('layouts.partials._notify')
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
      });

    });

  </script>
	<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
	webshims.setOptions('waitReady', false);
	webshims.setOptions('forms-ext', {types: 'date'});
	webshims.polyfill('forms forms-ext');
</script>
</body>
</html>
