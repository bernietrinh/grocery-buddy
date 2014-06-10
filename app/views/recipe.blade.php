@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
		
		<div class="container">
			<h2>{{ $recipe->name }}</h2>

			<p>Servings: {{ $recipe->numberOfServings }}</p>
			@if (!empty($recipe->totalTime))
			<p>Total Time: {{ $recipe->totalTime }}</p>
			@elseif (!empty($recipe->totalTimeInSeconds))
			<p>Total Time: {{ $recipe->totalTimeInSeconds }} mins</p>
			@endif
			<p>Rating: {{ $recipe->rating }}</p>
			

			<img src="{{ $recipe->images[0]->hostedLargeUrl }}" alt="">
			<h3>Ingredients</h3>
			<ul>
				@foreach ($recipe->ingredientLines as $ingredient)
				<li>{{ $ingredient }}</li>
				@endforeach
			</ul>

			<h3>Preparation</h3>
			<a href="{{ $recipe->source->sourceRecipeUrl }}">Follow instructions at {{ $recipe->source->sourceDisplayName }}</a>
			<a href="{{ $recipe->attribution->url }}">Link to source</a>
		</div>

	@endif
@stop