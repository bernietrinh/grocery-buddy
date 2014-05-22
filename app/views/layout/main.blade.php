<!DOCTYPE html>
<html>
	<head>
		<title>Shelf-Life</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" type="text/css">
	</head>
	<body>

		@if(Session::has('global'))
			{{ Session::get('global') }}
		@endif

		@include('layout.navigation')
		@yield('content')
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

		@yield('custom_scripts')
	</body>

</html>