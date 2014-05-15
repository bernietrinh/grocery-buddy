@extends('layout.main')

@section('content')
	{{ Form::open(array('route' => 'account-login')) }}
		
		<div class="field">
			{{ Form::label('username', 'Username: ') }}
			{{ Form::text('username') }}
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		
		<div class="field">
			{{ Form::label('password', 'Password: ') }}
			{{ Form::password('password') }}
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<div class="field">
			{{ Form::label('remember', 'Remember Me')}}
			{{ Form::checkbox('remember', 'remember') }}
		</div>
		
		{{ Form::submit('Login') }}
		
		<a href="{{ URL::route('account-forgot') }}">Forgot your password?</a>
	{{ Form::close() }}

	

@stop