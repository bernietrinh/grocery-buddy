@extends('layout.main')

@section('content')

	<p>Hello, {{ Auth::user()->username }}</p>
	
	<div class="container">

		<a href="{{ URL::route('shelf-add') }} ">Add new item to shelf</a>

		<!-- Displaying shelf items -->
		<!-- Fridge -->
		<h2>Fridge</h2>
		@foreach ($fridge_items as $fridge)
		<ul>
			<li>Item: {{ $fridge->name }}</li>
			<li><a href="{{ URL::route('shelf-edit') }}">Edit</a></li>
			<li><a href="#">Remove</a></li>
			<li>Brand: {{ $fridge->brand }}</li>
			<li>Location: {{ $fridge->location }}</li>
			@if(!empty($fridge->description)) 
			<li>Description: {{ $fridge->description }}</li>
			@endif
			<li>Purchase date: {{ $fridge->purchase_date }}</li>
			<li>Expiry: {{ $fridge->expiry_date }}</li>
		</ul>
		@endforeach
		
		<h2>Freezer</h2>
		@foreach ($freezer_items as $freezer)
		<ul>
			<li>Item: {{ $freezer->name }}</li>
			<li>Brand: {{ $freezer->brand }}</li>
			<li>Location:{{ $freezer->location }}</li>
			<li>Description: {{ $freezer->description }}</li>
			<li>Purchase date: {{ $freezer->purchase_date }}</li>
			<li>Expiry: {{ $freezer->expiry_date }}</li>
		</ul>
		@endforeach
		
		<h2>Pantry</h2>
		@foreach ($pantry_items as $pantry)
		<ul>
			<li>{{ $pantry->place }}</li>
			<li>{{ $pantry->brand }}</li>
			<li>{{ $pantry->location }}</li>
			<li>{{ $pantry->description }}</li>
			<li>{{ $pantry->purchase_date }}</li>
			<li>{{ $pantry->expiry_date }}</li>
		</ul>
		@endforeach


	</div>

@stop