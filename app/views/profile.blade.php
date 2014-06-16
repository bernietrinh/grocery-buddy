@extends('layout.main')

@section('content')
<div id="profile">
	<h2>Welcome {{Auth::user()->username }}...</h2>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Expiring this week...</h3>
				</div>
				<div class="panel-body">
					<table class="table table-hover table-condensed table-responsive">
						<thead>
							<th>Item</td>
							<th>Purchased</td>
							<th>Expiring</td>
						</thead>
						<tbody>
					@foreach ($expirings as $expiring)
						<tr>
							<td>{{ $expiring->name }}</td>
							<td>{{ date("F j", strtotime($expiring->purchase_date)) }}</td>
							<td>{{ date("F j", strtotime($expiring->expiry_date)) }}</td>
						</tr>
					@endforeach
						</tbody>
					</table>

					<a href="{{ URL::route('shelf') }}" class="btn btn-primary"><i class="fa fa-cutlery fa-fw"></i>View in Shelf</a>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Some delicious recipes to make...</h3>
				</div>
				<div class="panel-body">
					<ul>
					@if ($recipes)
						@foreach ($recipes as $recipe) 
							@if ($count == 1)
								<li><a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[2]->id) }}">{{ $recipe->matches[2]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[3]->id) }}">{{ $recipe->matches[3]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[4]->id) }}">{{ $recipe->matches[4]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[5]->id) }}">{{ $recipe->matches[5]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[6]->id) }}">{{ $recipe->matches[6]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[7]->id) }}">{{ $recipe->matches[7]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
							@elseif ($count <= 3)
								<li><a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[2]->id) }}">{{ $recipe->matches[2]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[3]->id) }}">{{ $recipe->matches[3]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
							@elseif ($count <= 6)
								<li><a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
								<li><a href="{{ URL::route('recipe', $recipe->matches[1]->id) }}">{{ $recipe->matches[1]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li>
							@else
								<li><a href="{{ URL::route('recipe', $recipe->matches[0]->id) }}">{{ $recipe->matches[0]->recipeName }}</a> with <span>{{ $recipe->shelf_ingredient }}</span></li> 
							@endif
						@endforeach
					@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop