@extends('layout.main')

@section('content')
	@if(Auth::check())

<div id="recipe">
	<main class="container">
		<ul class="pager">
		  <li class="previous"><a href="{{ URL::route('profile') }}">&larr; Back</a></li>
		</ul>
		<h2>{{ $recipe->name }}</h2>

		<p><i class="fa fa-cutlery fa-fw"></i><span>Servings:</span> {{ $recipe->numberOfServings }}</p>
		@if (!empty($recipe->totalTime))
		<p><i class="fa fa-clock-o fa-fw"></i><span>Total Time:</span> {{ $recipe->totalTime }}</p>
		@elseif (!empty($recipe->totalTimeInSeconds))
		<p><span>Total Time:</span> {{ $recipe->totalTimeInSeconds }} mins</p>
		@endif
		@if ($recipe->rating == 1)
		<p class="rating">
			Rating:
			<i class="fa fa-star fa-2x"></i>
		</p>
		@elseif ($recipe->rating == 2)
		<p class="rating">
			Rating:
			<i class="fa fa-star fa-2x"></i>
		</p>
		@elseif ($recipe->rating == 3)
		<p class="rating">
			Rating:
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
		</p>
		@elseif ($recipe->rating == 4)
		<p class="rating">
			Rating:
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
		</p>
		@else
		<p class="rating">
			Rating:
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
			<i class="fa fa-star fa-2x"></i>
		</p>
		@endif

		<img src="{{ $recipe->images[0]->hostedLargeUrl }}" alt="Recipe Image">
		<h3>Ingredients</h3>
		<ul>
			@foreach ($recipe->ingredientLines as $ingredient)
			<li>{{ $ingredient }}</li>
			@endforeach
		</ul>

		<h3>Preparation</h3>
		<a href="{{ $recipe->source->sourceRecipeUrl }}">Follow instructions at {{ $recipe->source->sourceDisplayName }}</a>

		<p>{{ $recipe->attribution->html }}</p>
	
	@endif
	</main>
</div>	
@stop