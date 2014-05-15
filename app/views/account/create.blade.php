@extends('layout.main')

@section('content')


	<!-- <form action="{{ URL::route('account-create') }}" method="POST">
		

		<input type="submit" value="Create Account">
		
	</form> -->
	{{ Form::open(array('route' => 'account-create')) }}
		
		<div class="field">
			{{ Form::label('email', 'Email: ') }}
			{{ Form::email('email') }}
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>
		
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
			{{ Form::label('password_conf', 'Confirm Password: ') }}
			{{ Form::password('password_conf') }}
			@if($errors->has('password_conf'))
				{{ 'Verify your password.' }}
			@endif
		</div>
		
		{{ Form::submit('Create Account') }}


	{{ Form::close() }}

@stop