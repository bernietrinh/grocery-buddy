@extends('layout.main')

@section('content')
	<div class="container">
		{{ Form::open() }}
			<div class="field">

				<section>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ strtolower($error) }}</li>
						@endforeach
					</ul>
				</section>
				<div class="ui-widget">
					{{ Form::label('item_name', 'Item:') }}
					{{ Form::text('item_name', null, array('id' => 'item_name', 'placeholder' => 'Enter item name')) }}
				</div>
			</div>
			
			{{ Form::hidden('item_id', null, array('id' => 'item_id')) }}

			<div class="field">
				{{ Form::label('place', 'Place in:') }}
				{{ Form::select('place', array(
					'fridge' => 'Fridge',
					'freezer' => 'Freezer',
					'pantry' => 'Pantry'
				)) }}
			</div>
			
			<div class="field">
				{{ Form::label('purchase', 'Purchase Date:') }}
				<input type="date" name="purchase" value="{{ date("Y-m-d", time()) }}">
			</div>
			
			<div class="field">
			{{ Form::label('expiry', 'Expiry Date:') }}
			<input type="date" name="expiry" value="{{ date("Y-m-d", time()) }}">
			</div>
		
			<div class="field">
				<div class="ui-widget">
				{{ Form::label('brand', 'Brand:') }}
				{{  Form::text('brand', null, array('id' => 'brand')) }}
				</div>
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

			{{ Form::submit('add to shelf', array('name' => 'add_to_shelf')) }}
		{{ Form::close() }}
	</div>
@stop

@section('custom_scripts')
<script>
	$(document).ready(function() {

		$(function() {
			$('#item_name').autocomplete({
				delay: 0,
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

		$(function() {
			$('#brand').autocomplete({
				source: "{{ URL::route('get-brand') }}",
				autoFocus: true,
				select: function(event, ui) {
					$('#brand').val(ui.item.value);
				}
			})
		});
	});

</script>
@stop