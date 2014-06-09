@extends('layout.main')

@section('content')

<div class="container">
	
	<section>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ strtolower($error) }}</li>
			@endforeach
		</ul>
	</section>
	
	{{ Form::model($item, array('route' => array('shelf-edit', $item->shelf_id)))}}
		<div class="field">
			<div class="ui-widget">
				{{ Form::label('name', 'Item:') }}
				{{ Form::text('name', $item->name, array('id' => 'name')) }}
			</div>
		</div>
		
		{{ Form::hidden('shelf_id', $item->shelf_id) }}
		{{ Form::hidden('item_id', $item->item_id, array('id' => 'item_id')) }}

		<div class="field">
			{{ Form::label('place', 'Place in:') }}
			{{ Form::select('place', array(
				'fridge' => 'Fridge',
				'freezer' => 'Freezer',
				'pantry' => 'Pantry'
			), strtolower($item->place)) }}
		</div>
		
		<div class="field">
			{{ Form::label('purchase', 'Purchase Date:') }}
			<input type="date" name="purchase" value="{{ $item->purchase_date }}">
		</div>
		
		<div class="field">
		{{ Form::label('expiry', 'Expiry Date:') }}
		<input type="date" name="expiry" value="{{ $item->expiry_date }}">
		</div>
	
		<div class="field">
			{{ Form::label('brand', 'Brand:') }}
			{{ Form::text('brand', null, array('id' => 'brand')) }}
		</div>
		
		<div class="field">
			{{ Form::label('quantity', 'Quantity:')}}
			{{ Form::selectRange('quantity', 1, 20) }}
		</div>
		
		<div class="field">
			{{ Form::label('location', 'Location:') }}
			{{ Form::text('location', null, array('id' => 'location')) }}
		</div>


		<div class="field">
			{{ Form::label('price', 'Price:') }}
			{{ Form::text('price', null, array('id' => 'price')) }}
		</div>

		<div class="field">
			{{ Form::label('desc', 'Description:') }}
			{{ Form::text('desc', null, array('id' => 'desc')) }}
		</div>
		
		<div class="field">
			{{ Form::checkbox('sale') }}
			{{ Form::label('sale', 'On sale?') }}
		</div>

		{{ Form::submit('update', array('name' => 'update_shelf', 'id' => 'update_shelf')) }}
	{{ Form::close() }}
</div>
@stop