@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
		<div class="container">
			<ul>

			@foreach ($items as $item)
				<li>
					{{ $item[0]->name }}
					<button class="toggle down">Add</button>

					{{ Form::open(array('class' => 'smart_list_form')) }}
						<input type="hidden" name="item" value="{{ $item[0]->item_id }}">
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