@extends('layout.main')

@section('content')
<div id="list">
	<main class="container">
		
		<h3>Smart Grocery Shopping List</h3>
		@if(Session::has('global'))
		{{ Session::get('global') }}
		@endif
		<!-- Smart list input field -->
		<div class="ui-widget">
			{{ Form::open() }}
				<div class="input-group margin-bottom-sm addtolist">
					<span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
					{{ Form::text('addtolist', null, array('placeholder' => 'Begin by adding an item', 'class' => 'form-control', 'autocomplete' => 'off', 'id' => 'addtolist')) }}
				</div>
						<i class="fa fa-list-alt btn btn-sm btn-success">{{ Form::submit('Add', array('name' => 'add_to_list')) }}</i>

				
				{{ Form::hidden('listitemid', null, array('id' => 'listitemid'))}}
			{{ Form::close() }}
			<div class="clearfix"></div>
		</div>


			
		<!-- Validation -->
		@if ($errors->all())
		<div class="panel panel-danger" id="validation">
			<div class="panel-heading">
				<h4 class="panel-title">Please correct the following errors</h4>
			</div>
			<div class="panel-body">
				<ul>
					@foreach ($errors->all() as $error)
					<li><i class="fa fa-exclamation fa-fw"></i>{{ strtolower($error) }}</li>
					@endforeach
				</ul>
			</div>
		</div>
		@endif

		<!-- Displaying list items -->
		<div id="panel-title">
			<h4>To Buy...</h4>
		</div>
		<ul class="list-group">
		@if ($items)
			@foreach ($items as $item)
			<li class="list-group-item">
				<header>
					<button data-toggle="collapse" data-target="#{{ $item->list_id }}" class="btn btn-info btn-xs"><i class="fa fa-check-circle fa-fw fa-lg"></i></button>
					@if(!($item->purchase_date))
					<h4 class="panel-title">{{ $item->name }} </h4>
					@else
					<!-- If item not purchased before -->
					<h4 class="toggle"><i class="fa fa-ellipsis-v fa-fw"></i>{{ $item->name }}</h4>
					@endif
					<!-- Remove from list -->
					{{ Form::open(array('action' => 'ListController@postDelete', 'class' => 'remove')) }}
						<input type="hidden" name="list_id_delete" value="{{ $item->list_id }}">
						<i class="btn btn-danger btn-xs fa fa-trash-o">{{ Form::submit('Remove') }}</i>
					{{ Form::close() }}
				</header>
				@if($item->purchase_date)
				<!-- If purchased before, info from last purchase -->
				<article class="clearfix">
					<ul>
						<li>Last Purchased on <span>{{ date("F j, Y", strtotime($item->purchase_date)) }}</span></li>
						<li>From: {{ $item->location }} for <span>{{ $item->price }}</span></li>
						<li>Brand: {{ $item->brand }} </li>
						@if(!empty($item->description))
							<li>Description: {{ $item->description }}</li>
						@endif
						@if($item->sale == true)
							<li><span>*{{ 'On Sale' }}</span></li>
						@endif
					</ul>
				</article>
				@endif
				<section id="{{ $item->list_id }}" class="collapse clearfix">
					<!-- Insert form into shelf -->
					{{ Form::open() }}
						<input type="hidden" name="item" id="item" value="{{ $item->item_id }}">
						<input type="hidden" name="list_id_add_del" id="list_id_add_del" value="{{ $item->list_id }}">
						{{ Form::label('purchase', 'Purchase Date:') }}
						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
							<input type="date" class="form-control" name="purchase" value="{{ date("Y-m-d", time()) }}">
						</div>
						<div class="center">
							<input type="checkbox" id="perishable" name="perishable" checked="checked" >
							{{ Form::label('perishable', 'Perishable?') }}
						</div>

						{{ Form::label('expiry', 'Expiry Date:') }}
						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
						<input type="date" class="form-control" id="expiry" name="expiry" value="{{ date("Y-m-d", time()) }}">
						</div>

						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
							{{  Form::text('brand', null, array('id' => 'brand', "class" => "form-control", "placeholder" => "Brand")) }}
						</div>

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

						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
							{{ Form::text('desc', null, array('id' => 'desc', 'class' => 'form-control', 'placeholder' => 'Description')) }}
						</div>
						
						<div class="center">
							{{ Form::checkbox('sale') }}
							{{ Form::label('sale', 'On sale?') }}
						</div>

						<div class="center">
							<button class="btn btn-info">
							<i class="fa fa-plus-circle fa-2x"></i>
							{{ Form::submit('Add to Shelf', array('name' => 'add_to_shelf')) }}
							</button>
						</div>
					{{ Form::close() }}
				</section>
			</li>
		@endforeach
		@else 
		<li class="list-group-item">Add items to your list.</li>
		
		@endif
		</ul> <!--#accordion-->
			
	</main>
</div>
@stop

@section('custom_scripts')
<script src="{{ URL::asset('js/autocomplete-form.js') }}"></script>
<script>
	$(document).ready(function() {

		$(function() {
			$('#addtolist').autocomplete({
				delay: 300,
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

		$('.toggle').parent().next().hide();

		$('.toggle').click(function() {
			$(this).parent().next().slideToggle(100, 'linear');
		})

	});

</script>

@stop