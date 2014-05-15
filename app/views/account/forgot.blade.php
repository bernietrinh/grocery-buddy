@extends('layout.main')

@section('content') 

{{ Form::open(array('route' => 'account-forgot')) }}
	
	<div class="field">
		{{ Form::label('email', 'Email: ') }}
		{{ Form::email('email') }}
		@if($errors->has('email'))
			{{ $errors->first('email') }}
		@endif
	</div>
	
	{{ Form::submit('Recover') }}
	
{{ Form::close() }}

@stop