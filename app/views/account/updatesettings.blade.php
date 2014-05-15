@extends('layout.main')

@section('content')
	{{ Form::open(array('url' => 'account/update-settings', 'method' => 'post')) }}
		
		<div class="field">
			{{ Form::label('username', 'Username: ') }}
			{{ Form::text('username') }}
		</div>


		<div class="field">
			{{ Form::label('new_password', 'New Password: ') }}
			{{ Form::password('new_password') }}
			@if($errors->has('new_password'))
				{{ $errors->first('new_password') }}
			@endif
		</div>

		<div class="field">
			{{ Form::label('new_password_conf', 'Confirm New Password: ') }}
			{{ Form::password('new_password_conf') }}
			@if($errors->has('new_password_conf'))
				{{ $errors->first('new_password_conf') }}
			@endif
		</div>

		<div class="field">
			{{ Form::label('password', 'Password: ') }}
			{{ Form::password('password') }}
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		
		{{ Form::submit('Update') }}
	{{ Form::close() }}
@stop