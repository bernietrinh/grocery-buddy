<!DOCTYPE html>
<html>
	<head>
		<title>Shelf-Life</title>
		<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" type="">
	</head>
	<body>

		@if(Session::has('global'))
			{{ Session::get('global') }}
		@endif

		@include('layout.navigation')
		@yield('content')
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="{{asset('js/smartList.js')}}"></script>
	</body>

</html>