@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
		<div class="container">

			<div class="ui-widget">
				{{ Form::label('addtolist', 'Add to Smart List:') }}
				<input type="text" id="addtolist">
			</div>

			<ul>
			@foreach ($items as $item)
				<li>
					@if(empty($item->purchase_date))
					{{ $item->name }}
					@else
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
					<button class="toggle down">Add</button>

					{{ Form::open(array('class' => 'smart_list_form')) }}
						<input type="hidden" name="item" value="{{ $item->item_id }}">
						{{ Form::submit('Remove Item', array('name' => 'list_remove', 'onclick' => 'return confirm("Are you sure?")')) }}
						<div class="form">
							<article>
								<div class="field">
									{{ Form::label('place', 'Put in your: ') }}
									{{ Form::select('place', array('fridge' => 'Fridge', 'freezer' => 'Freezer', 'pantry' => 'Pantry')) }}
									@if($errors->has('email'))
										{{ $errors->first('email') }}
									@endif
								</div>
								
								<div class="field">
									{{ Form::label('purchase', 'Purchase Date: ') }}
									<input type="date" id="purchase" name="purchase">
									@if($errors->has('username'))
										{{ $errors->first('username') }}
									@endif
								</div>
								
								<div class="field">
									{{ Form::label('expiry', 'Expiry Date: ') }}
									<input type="date" id="expiry" name="expiry">
									@if($errors->has('password'))
										{{ $errors->first('password') }}
									@endif
								</div>
								
								<div class="field">
									{{ Form::label('brand', 'Brand: ') }}
									{{ Form::text('brand') }}
									@if($errors->has('password_conf'))

									@endif
								</div>

								<div class="field">
									{{ Form::label('quantity', 'Quantity: ') }}
									{{ Form::text('quantity') }}
									@if($errors->has('password_conf'))

									@endif
								</div>

								<div class="field">
									{{ Form::label('location', 'Location: ') }}
									{{ Form::text('location') }}
									@if($errors->has('password_conf'))

									@endif
								</div>

								<div class="field">
									{{ Form::label('price', 'Price: ') }}
									{{ Form::text('price') }}
									@if($errors->has('password_conf'))

									@endif
								</div>

								<div class="field">
									{{ Form::label('description', 'Description: ') }}
									{{ Form::text('description') }}
									@if($errors->has('password_conf'))

									@endif
								</div>
								
								<div class="field">
									{{ Form::label('sale', 'Sale? ') }}
									{{ Form::checkbox('sale') }}
									@if($errors->has('password_conf'))

									@endif
								</div>


								{{ Form::submit('Add to Shelf', array('name' => 'list_add_to_shelf')) }}
							</article>
						</div> <!-- .form end -->
					{{ Form::close() }}
				</li>
			@endforeach
			</ul> 

		</div>

	@else
	
	@endif

@stop

@section('custom_scripts')
<script src="{{asset('js/smartList.js')}}"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
$(document).ready(function() {

	$(function() {
		$('#addtolist').autocomplete({
			source: "{{ URL::route('smart-list-add') }}",
			autoFocus: true,
			select: function(event, ui) {
				$('#addtolist').val(ui.item.value);
			}
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		      return $( "<li>" ).append( "<a>" + item.label + "<br><span style='font-size: 12px'>" + item.desc + "</span></a>" ).appendTo( ul );
	    };
	});
});
</script>
@stop