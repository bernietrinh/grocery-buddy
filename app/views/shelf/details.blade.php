@extends('layout.main')

@section('content')

<div class="container">
	<br>{{ $item->name }}
	<br>{{ $item->place }}
	<br>{{ $item->purchase_date }}
	<br>{{ $item->expiry_date }}
	<br>{{ $item->price }}
	<br>{{ $item->brand }}
	<br>{{ $item->quantity }}
	<br>{{ $item->location }}
	@if(!empty($item->description)) 
	<br>Description: {{ $item->description }}
	@endif
	<br>{{ $item->shelf_id }}

	<a href="{{URL::route('shelf-edit', $item->shelf_id)}}">Edit</a>
</div>

@stop