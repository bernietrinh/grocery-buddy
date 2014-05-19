@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>
		<div class="container">
			<ul>
			@foreach ($list_items as $list_item)
				<li>
					{{ Form::open() }}
						<input type="checkbox" name="item" value="{{ $list_item->item_id }}">
						{{ $list_item->item_id }}
					{{ Form::close() }}
					
				</li>
			@endforeach
			</ul> 
		</div>
	@else

	@endif
@stop