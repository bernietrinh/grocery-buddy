<!DOCTYPE html>
<html>
	<head>
		<title>Shelf-Life</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Permanent+Marker|PT+Sans+Narrow|Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="{{ URL::asset('css/styles.min.css') }}" type="text/css">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		    <![endif]-->
	</head>
	<body>
		@if (Auth::check())
			@include('layout.navigation')
		@endif

		@yield('content')

		
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

		@yield('custom_scripts')
	</body>

</html>