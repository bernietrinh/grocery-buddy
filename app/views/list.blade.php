@extends('layout.main')

@section('content')

	<p>Hello, {{ Auth::user()->username }}</p>
	<div class="container">
		
		<!-- Smart list input field -->
		<div class="ui-widget">
			{{ Form::open() }}
				{{ Form::label('addtolist', 'Add to Smart List:') }}
				{{ Form::text('addtolist', null, array('id'=>'addtolist', 'placeholder' => 'Enter item name')) }}
				{{ Form::hidden('listitemid', null, array('id' => 'listitemid'))}}
				{{ Form::submit('add to smart list', array('name' => 'add_to_list')) }}
			{{ Form::close() }}
		</div>
		
		<!-- Validation -->
		<section>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ strtolower($error) }}</li>
				@endforeach
			</ul>
		</section>
		
		<!-- Displaying list items -->
		<ul>
		@foreach ($items as $item)
			<li>
				<!-- If not purchased before -->
				@if(empty($item->purchase_date))
				{{ $item->name }}
				@else
				<!-- If purchased before, info from last purchase -->
				<span class="more_info">{{ $item->name }}</span>
				<ul>
					<li>Last Purchase Date: {{ $item->purchase_date }}</li>
					<li>Location: {{ $item->location }}</li>
					<li>Price: {{ $item->price }}</li>
					<li>Brand: {{ $item->brand }} </li>
					@if(!empty($item->description))
						<li>Description: {{ $item->description }}</li>
					@endif
					@if($item->sale == true)
						<li>{{ 'On Sale' }}</li>
					@endif
				</ul>
				@endif
				<!-- Insert form into shelf -->
				<button class="toggle down">Add</button>

				{{ Form::open() }}
					<input type="hidden" name="item" id="item" value="{{ $item->id }}">
					
					<!-- Remove from list -->
					{{ Form::submit('Remove Item', array('name' => 'list_remove', 'onclick' => 'return confirm("Are you sure?")')) }}

					<!-- Add to list -->
					<div class="form">
						<article>
							<div class="field">
								{{ Form::label('place', 'Put in your: ') }}
								{{ Form::select('place', array('fridge' => 'Fridge', 'freezer' => 'Freezer', 'pantry' => 'Pantry')) }}
							</div>
							
							<div class="field">
								{{ Form::label('purchase', 'Purchase Date: ') }}
								<input type="date" id="purchase" name="purchase">
							</div>
							
							<div class="field">
								{{ Form::label('expiry', 'Expiry Date: ') }}
								<input type="date" id="expiry" name="expiry">
							</div>
							
							<div class="field">
								{{ Form::label('brand', 'Brand: ') }}
								{{ Form::text('brand') }}
							</div>

							<div class="field">
								{{ Form::label('quantity', 'Quantity: ') }}
								{{ Form::selectRange('quantity', 1, 20) }}
							</div>

							<div class="field">
								{{ Form::label('location', 'Location: ') }}
								{{ Form::text('location') }}
							</div>

							<div class="field">
								{{ Form::label('price', 'Price: ') }}
								{{ Form::text('price') }}
							</div>

							<div class="field">
								{{ Form::label('description', 'Description: ') }}
								{{ Form::text('description') }}
							</div>
							
							<div class="field">
								{{ Form::label('sale', 'Sale? ') }}
								{{ Form::checkbox('sale') }}
							</div>


							{{ Form::submit('Add to Shelf', array('name' => 'add_to_shelf')) }}
						</article>
					</div> <!-- .form end -->
				{{ Form::close() }}
			</li>
		@endforeach
		</ul> 

	</div>

@stop

@section('custom_scripts')
<script src="{{asset('js/smartList.js')}}"></script>

<script>
	$(document).ready(function() {

		$(function() {
			$('#addtolist').autocomplete({
				delay: 0,
				source: "{{ URL::route('smart-list-add') }}",
				autoFocus: true,
				select: function(event, ui) {
					$('#addtolist').val(ui.item.value);
					$('#listitemid').val(ui.item.id);
				}
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			      return $( "<li>" ).append( "<a>" + item.label + "<br><span style='font-size: 12px'>" + item.desc + "</span></a>" ).appendTo( ul );
		    };
		});
	});

</script>

@stop