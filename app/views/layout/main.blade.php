<!DOCTYPE html>
<html>
	<head>
		<title>Fridge</title>
	</head>
	<body>

		@if(Session::has('global'))
			{{ Session::get('global') }}
		@endif

		@include('layout.navigation')
		@yield('content')
	</body>
</html>