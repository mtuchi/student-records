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
		window.setTimeout(function() {
				$(".notify").fadeTo(5000, 0).slideUp(5000, function(){
						$(this).remove();
				});
		}, {{ notify()->option('timer') ? notify()->option('timer') : 2000 }});
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
