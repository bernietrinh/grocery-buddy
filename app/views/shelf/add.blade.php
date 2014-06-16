@extends('layout.main')

@section('content')
<div id="shelf_add">
	<main class="container">
		<ul class="pager">
		  <li class="previous"><a href="{{ URL::route('shelf') }}">&larr; Back</a></li>
		</ul>

		{{ Form::open() }}
			<h3>Add a new item to your Shelf</h3>

			@if(Session::has('global'))
			{{ Session::get('global') }}
			@endif

			<div class="ui-widget input-group margin-bottom-sm">

				<span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
				{{ Form::text('item_name', null, array('id' => 'item_name', 'placeholder' => 'Enter an item', 'class' => 'form-control', 'autofocus', 'autocomplete' => 'off')) }}
			</div>
			@if($errors->has('item_name'))
				<p class="alert alert-danger">{{ $errors->first('item_name') }}</p>
			@endif
			
			{{ Form::hidden('item_id', null, array('id' => 'item_id')) }}
			
			{{ Form::label('purchase', 'Purchase Date:') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
				<input type="date" class="form-control" name="purchase" value="{{ date("Y-m-d", time()) }}">
			</div>
			@if($errors->has('purchase'))
				<p class="alert alert-danger">{{ $errors->first('purchase') }}</p>
			@endif
			
			<div class="center">
				<input type="checkbox" id="perishable" name="perishable" checked="checked" >
				{{ Form::label('perishable', 'Perishable?') }}
			</div>

			{{ Form::label('expiry', 'Expiry Date:') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
			<input type="date" class="form-control" id="expiry" name="expiry" value="{{ date("Y-m-d", time()) }}">
			</div>
			
			@if($errors->has('expiry'))
				<p class="alert alert-danger">{{ $errors->first('expiry') }}</p>
			@endif
		
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
				{{  Form::text('brand', null, array('id' => 'brand', "class" => "form-control", "placeholder" => "Brand")) }}
			</div>
			@if($errors->has('brand'))
				<p class="alert alert-danger">{{ $errors->first('brand') }}</p>
			@endif
			
			<div class="center">
				{{ Form::label('place', 'Place in:') }}
				{{ Form::select('place', array(
					'fridge' => 'Fridge',
					'freezer' => 'Freezer',
					'pantry' => 'Pantry'
				), '', array('class' => 'form-control')) }}				
				{{ Form::label('quantity', 'Quantity:')}}
				{{ Form::select('quantity', ['-',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], null, ['class' => 'form-control']) }}
			</div>
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-location-arrow fa-fw"></i></span>
				{{ Form::text('location', null, array('id' => 'location', "class" => "form-control", "placeholder" => "Location")) }}
			</div>

			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-dollar fa-fw"></i></span>
				{{ Form::text('price', null, array('id' => 'price', 'class' => 'form-control', 'placeholder' => 'Price')) }}
			</div>
			@if($errors->has('price'))
				<p class="alert alert-danger">{{ $errors->first('price') }}</p>
			@endif

			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
				{{ Form::text('desc', null, array('id' => 'desc', 'class' => 'form-control', 'placeholder' => 'Description')) }}
			</div>
			
			<div class="center">
				{{ Form::checkbox('sale') }}
				{{ Form::label('sale', 'On sale?') }}
			</div>
			
			<button class="btn btn-info">
				<i class="fa fa-plus-circle fa-2x"></i>
				{{ Form::submit('Add to Shelf', array('name' => 'add_to_shelf')) }}
			</button>
		{{ Form::close() }}
	</main>
</div>
@stop

@section('custom_scripts')
<script src="{{ URL::asset('js/autocomplete-form.js') }}"></script>

<script>
$(document).ready(function() {

	$(function() {
		$('#item_name').autocomplete({
			delay: 300,
			source: "{{ URL::route('smart-list-add') }}",
			autoFocus: true,
			select: function(event, ui) {
				$('#item_name').val(ui.item.value);
				$('#item_id').val(ui.item.id);
			}
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		      return $( "<li>" ).append( "<a>" + item.label + "<br><span style='font-size: 12px'>" + item.desc + "</span></a>" ).appendTo( ul );
	    };
	});
});
</script>
@stop