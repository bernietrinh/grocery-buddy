@extends('layout.main')

@section('content')
	<div id="shelf_index">	
		<main class="container">
			
			<a class="label label-info" href="{{ URL::route('shelf-add') }} "><i class="fa fa-plus-circle fa-2x"></i>Add new item to shelf</a>

			@if(Session::has('global'))
			{{ Session::get('global') }}
			@endif

			<div class="row">
		        <div class="col-sm-12 col-md-6 col-lg-4">
		          <div class="panel panel-success">
		            <div class="panel-heading">
		              <h3 class="panel-title">Fridge</h3>
		            </div>
		            <div class="panel-body">
		            	<ul class="listgroup">

		            		@foreach ($fridge_items as $fridge)
		            			<li class="list-group-item">
			            		@if ($fridge->category == "Dairy")
			            			<img src="{{ URL::asset('img/cat/dairy-icon.png') }}" alt="dairy">
			            		@elseif($fridge->category == "Vegetables")
			            			<img src="{{ URL::asset('img/cat/vegetables-icon.png') }}" alt="veggies">
			            		@elseif($fridge->category == "Fruit")
			            			<img src="{{ URL::asset('img/cat/fruits-icon.png') }}" alt="fruits">
			            		@elseif($fridge->category == "Wheat")
			            			<img src="{{ URL::asset('img/cat/wheat-icon.png') }}" alt="wheat">
			            		@elseif($fridge->category == "Meat")
			            			<img src="{{ URL::asset('img/cat/meat-icon.png') }}" alt="meat">
			            		@elseif($fridge->category == "Oils")
			            		@elseif($fridge->category == "Beverages")
			            			<img src="{{ URL::asset('img/cat/beverages-icon.png') }}" alt="beverages">
			            		@elseif($fridge->category == "Seafood")
			            			<img src="{{ URL::asset('img/cat/seafood-icon.png') }}" alt="seafood">
			            		@elseif($fridge->category == "Other")
			            		@endif
			            			<p>
				            			<a href="{{ URL::route('shelf-details', $fridge->shelf_id) }}">{{ $fridge->name }}</a>
				            			{{ Form::open() }}
				            				{{ Form::hidden('shelf_id', $fridge->shelf_id) }}
				            				<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-sm"></i>{{ Form::submit('Delete', array('class' => 'remove')) }}</button>
			            				{{ Form::close() }}
			            				<a class="edit btn btn-warning btn-xs" href="{{URL::route('shelf-edit', $fridge->shelf_id)}}"><i class="fa fa-edit fa-sm"></i>Edit</a>
										<span>Quantity: {{ $fridge->quantity }}</span>
										<span class="expires">Expires: {{ date("F j, Y", strtotime($fridge->expiry_date)) }}</span>

			            			</p>
	            				
			            		</li>
		            		@endforeach
		            	</ul>
		            </div>
		          </div>
		        </div><!-- /.col-sm-4 -->
		        <div class="col-sm-12 col-md-6 col-lg-4">
		          <div class="panel panel-danger">
		            <div class="panel-heading">
		              <h3 class="panel-title">Freezer</h3>
		            </div>
		            <div class="panel-body">
    	            	<ul class="listgroup">

    	            		@foreach ($freezer_items as $freezer)
    	            			<li class="list-group-item">
    		            		@if ($freezer->category == "Dairy")
    		            		@elseif($freezer->category == "Vegetables")
    		            			<img src="{{ URL::asset('img/cat/vegetables-icon.png') }}" alt="veggies">
    		            		@elseif($freezer->category == "Fruit")
    		            			<img src="{{ URL::asset('img/cat/fruits-icon.png') }}" alt="fruits">
    		            		@elseif($freezer->category == "Wheat")
    		            			<img src="{{ URL::asset('img/cat/wheat-icon.png') }}" alt="wheat">
    		            		@elseif($freezer->category == "Meat")
    		            			<img src="{{ URL::asset('img/cat/meat-icon.png') }}" alt="meat">
    		            		@elseif($freezer->category == "Oils")
    		            		@elseif($freezer->category == "Beverages")
    		            			<img src="{{ URL::asset('img/cat/beverages-icon.png') }}" alt="beverages">
    		            		@elseif($freezer->category == "Seafood")
    		            			<img src="{{ URL::asset('img/cat/seafood-icon.png') }}" alt="seafood">
    		            		@elseif($freezer->category == "Other")
    		            		@endif
    		            			<p>
    			            			<a href="{{ URL::route('shelf-details', $freezer->shelf_id) }}">{{ $freezer->name }}</a>
    			            			{{ Form::open() }}
    			            				{{ Form::hidden('shelf_id', $freezer->shelf_id) }}
    			            				<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-sm"></i>{{ Form::submit('Delete', array('class' => 'remove')) }}</button>
    		            				{{ Form::close() }}
    		            				<a class="edit btn btn-warning btn-xs" href="{{URL::route('shelf-edit', $fridge->shelf_id)}}"><i class="fa fa-edit fa-sm"></i>Edit</a>
    									<span>Quantity: {{ $freezer->quantity }}</span>
    									<span class="expires">Expires: {{ date("F j, Y", strtotime($freezer->expiry_date)) }}</span>

    		            			</p>
    	           				
    		            		</li>
    	            		@endforeach
    	            	</ul>
		            </div>
		          </div>
		        </div><!-- /.col-sm-4 -->
		        <div class="col-sm-12 col-md-6 col-lg-4">
		          <div class="panel panel-warning">
		            <div class="panel-heading">
		              <h3 class="panel-title">Pantry</h3>
		            </div>
		            <div class="panel-body">
    	            	<ul class="listgroup">
							@endif
    	            		@foreach ($pantry_items as $pantry)
    	            			<li class="list-group-item">
    		            		@if ($pantry->category == "Dairy")
    		            		@elseif($pantry->category == "Vegetables")
    		            			<img src="{{ URL::asset('img/cat/vegetables-icon.png') }}" alt="veggies">
    		            		@elseif($pantry->category == "Fruit")
    		            			<img src="{{ URL::asset('img/cat/fruits-icon.png') }}" alt="fruits">
    		            		@elseif($pantry->category == "Wheat")
    		            			<img src="{{ URL::asset('img/cat/wheat-icon.png') }}" alt="wheat">
    		            		@elseif($pantry->category == "Meat")
    		            			<img src="{{ URL::asset('img/cat/meat-icon.png') }}" alt="meat">
    		            		@elseif($pantry->category == "Oils")
    		            		@elseif($pantry->category == "Beverages")
    		            			<img src="{{ URL::asset('img/cat/beverages-icon.png') }}" alt="beverages">
    		            		@elseif($pantry->category == "Seafood")
    		            			<img src="{{ URL::asset('img/cat/seafood-icon.png') }}" alt="seafood">
    		            		@elseif($pantry->category == "Other")
    		            		@endif
    		            			<p>
    			            			<a href="{{ URL::route('shelf-details', $pantry->shelf_id) }}">{{ $pantry->name }}</a>
    			            			{{ Form::open() }}
    			            				{{ Form::hidden('shelf_id', $pantry->shelf_id) }}
    			            				<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-sm"></i>{{ Form::submit('Delete', array('class' => 'remove')) }}</button>
    		            				{{ Form::close() }}
    		            				<a class="edit btn btn-warning btn-xs" href="{{URL::route('shelf-edit', $fridge->shelf_id)}}"><i class="fa fa-edit fa-sm"></i>Edit</a>
    									<span>Quantity: {{ $pantry->quantity }}</span>
    									<span class="expires">Expires: {{ date("F j, Y", strtotime($pantry->expiry_date)) }}</span>
    		            			</p>
    		            		</li>
    	            		@endforeach
    	            	</ul>
		            </div>
		          </div>
		        </div><!-- /.col-sm-4 -->
			</div>
		</main>
	</div>
@stop