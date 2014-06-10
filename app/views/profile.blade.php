@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
	@endif
	
	<div class="container">
		<h3>Expiring this week...</h3>
		<ul>
		@foreach ($expirings as $expiring)
			<li>{{ $expiring->name }}</li>
		@endforeach
		</ul>
	
	
		<ul>
			@foreach ($recipes as $recipe) 
				@if ($count == 1)
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[2]->id) }}">{{ $recipe->matches[2]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[3]->id) }}">{{ $recipe->matches[3]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[4]->id) }}">{{ $recipe->matches[4]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[5]->id) }}">{{ $recipe->matches[5]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[6]->id) }}">{{ $recipe->matches[6]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[7]->id) }}">{{ $recipe->matches[7]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
				@elseif ($count <= 3)
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[2]->id) }}">{{ $recipe->matches[2]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[3]->id) }}">{{ $recipe->matches[3]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
				@elseif ($count <= 6)
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li>
				@else
					<li>make <a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with {{ $recipe->shelf_ingredient }}</li> 
				@endif
			@endforeach
		</ul>
	</div>

@stop