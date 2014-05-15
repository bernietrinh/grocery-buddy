@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
	@else
		<p>Not signed in.</p>
	@endif
@stop