@extends('layout.main')

@section('content')

<div id="shelf_edit">
	<main class="container">
	
	<ul class="pager">
	  <li class="previous"><a href="{{ URL::route('shelf') }}">&larr; Back to Shelf</a></li>
	</ul>

	{{ Form::model($item, array('route' => array('shelf-edit', $item->shelf_id)))}}

		<h3>Edit {{ $item->name }} in your Shelf</h3>
		
		{{ Form::hidden('shelf_id', $item->shelf_id) }}
		{{ Form::hidden('item_id', $item->item_id, array('id' => 'item_id')) }}

		
		
		{{ Form::label('purchase', 'Purchase Date:') }}
		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
			<input type="date" class="form-control" name="purchase" value="{{ $item->purchase_date }}">
		</div>
		@if($errors->has('purchase'))
			<p class="alert alert-danger">{{ $errors->first('purchase') }}</p>
		@endif
		
		<div class="center">
		@if($item->expiry_date != null)
			<input type="checkbox" id="perishable" name="perishable" checked="checked">
		@else
			<input type="checkbox" id="perishable" name="perishable">
		@endif
			{{ Form::label('perishable', 'Perishable?') }}
		</div>

		{{ Form::label('expiry', 'Expiry Date:') }}
		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
		<input type="date" class="form-control" id="expiry" name="expiry" value="{{ $item->expiry_date }}">
		</div>
		@if($errors->has('expiry'))
			<p class="alert alert-danger">{{ $errors->first('expiry') }}</p>
		@endif

		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i>Brand: </span>
			{{  Form::text('brand', null, array('id' => 'brand', "class" => "form-control")) }}
		</div>
		
		<div class="center">
			{{ Form::label('place', 'Place in:') }}
			{{ Form::select('place', array(
				'fridge' => 'Fridge',
				'freezer' => 'Freezer',
				'pantry' => 'Pantry'
			), strtolower($item->place), array('class' => 'form-control')) }}				
			{{ Form::label('quantity', 'Quantity:')}}
			{{ Form::select('quantity', ['-',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], null, ['class' => 'form-control']) }}
		</div>
		
		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-location-arrow fa-fw"></i>Location: </span>
			{{ Form::text('location', null, array('id' => 'location', "class" => "form-control")) }}
		</div>
	
		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-dollar fa-fw"></i>Price: </span>
			{{ Form::text('price', null, array('id' => 'price', 'class' => 'form-control')) }}
		</div>
		@if($errors->has('price'))
			<p class="alert alert-danger">{{ $errors->first('price') }}</p>
		@endif

		<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i>Description:</span>
			{{ Form::text('desc', null, array('id' => 'desc', 'class' => 'form-control')) }}
		</div>
		
		<div class="center">
			{{ Form::checkbox('sale') }}
			{{ Form::label('sale', 'On sale?') }}
		</div>

		<button class="btn btn-info">
			<i class="fa fa-edit fa-2x"></i>
			{{ Form::submit('Update ' . $item->name, array('name' => 'update_shelf', 'id' => 'update_shelf')) }}
		</button>

	{{ Form::close() }}

	</main>
</div>
@stop

@section('custom_scripts')
<script>
$(document).ready(function() {

	var expiry = $('#expiry');

	function check() {
		if($('#perishable').prop('checked') == false) {
			expiry.attr('disabled', 'disabled');
			expiry.removeAttr('enabled', 'enabled');
		} else {
			expiry.removeAttr('disabled', 'disabled');
			expiry.attr('enabled', 'enabled');
		}
	}

	check();

	$('#perishable').change(function() {
		check();
	});
});
</script>
@stop