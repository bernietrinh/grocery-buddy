@extends('layout.main')

@section('content')
<div id="shelf_details">	
	<main class="container">
		<ul class="pager">
		  <li class="previous"><a href="{{ URL::route('shelf') }}">&larr; Back</a></li>
		  <li class="next"><a href="{{ URL::route('shelf-edit', $item->shelf_id) }}">Edit &rarr;</a></li>
		</ul>

		<div class="panel panel-info ">
			<div class="panel-heading">
				@if (strtolower($item->place) == "fridge")
				<img src="{{ URL::asset('img/fridge-icon.png') }}" alt="fridge">
				@elseif (strtolower($item->place) == "freezer")
				<img src="{{ URL::asset('img/freezer.png') }}" alt="freezer">
				@else
				<img src="{{ URL::asset('img/pantry.png') }}" alt="pantry">
				@endif
				<h3 class="panel-title">{{ $item->name }}</h3><span class="badge">{{ $item->quantity }}</span>
			</div>
			<div class="panel-body">
				<p>
					@if($item->expiry_date != null)
					Expires <span>{{ date("F j, Y", strtotime($item->expiry_date)) }}</span>
					@else
					Non-perisable item.
					@endif
				</p>
				<p>
					This item was purchased on <span>{{ date("F j, Y", strtotime($item->purchase_date)) }}</span> @if(!empty($item->location))from <span>{{ $item->location }}</span>. @endif
				</p>
				<ul>
					<li>Price: ${{ $item->price }}</li>
					@if ($item->brand != 'N/A')
					<li>Brand: {{ $item->brand }}</li>
					@endif
					@if(!empty($item->description)) 
					<li>Description: {{ $item->description }}</li>
					@endif
				</ul>
            </div>
            <div class="panel-footer">
				{{ Form::open(array('route' => 'shelf-delete')) }}
    				{{ Form::hidden('shelf_id', $item->shelf_id) }}
    				<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-sm"></i>{{ Form::submit('Delete', array('class' => 'remove')) }}</button>
				{{ Form::close() }}
            	<div class="clearfix"></div>
            </div>
		</div>
	</main>
</div>


</div>

@stop