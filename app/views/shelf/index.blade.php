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
			<li><a href="{{ URL::route('shelf-details', $fridge->shelf_id) }}">More Details</a></li>
			<li>
				{{ Form::open() }}
				{{ Form::hidden('shelf_id', $fridge->shelf_id) }}
				{{ Form::submit('remove') }}
				{{ Form::close() }}
			</li>
			<li>Quantity: {{ $fridge->quantity }}</li>
			
			<li>Purchase date: {{ $fridge->purchase_date }}</li>
			<li>Expiry: {{ $fridge->expiry_date }}</li>
		</ul>
		@endforeach
		
		<h2>Freezer</h2>
		@foreach ($freezer_items as $freezer)
		<ul>
			<li>Item: {{ $freezer->name }}</li>
			<li>ID: {{ $freezer->id }}</li>
			<li><a href="{{ URL::route('shelf-details', $freezer->shelf_id) }}">More Details</a></li>
			<li><a href="URL::action('ShelfController@postDeleteShelf', $freezer->shelf_id)">Remove</a></li>
			<li>Brand: {{ $freezer->brand }}</li>
			<li>quantity:{{ $freezer->quantity }}</li>
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
			<li>{{ $pantry->quantity }}</li>
			<li>{{ $pantry->description }}</li>
			<li>{{ $pantry->purchase_date }}</li>
			<li>{{ $pantry->expiry_date }}</li>
		</ul>
		@endforeach


	</div>

@stop