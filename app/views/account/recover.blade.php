@extends('layout.main')

@section('content')
	{{ Form::open(array('url' => 'account/recover', 'method' => 'post')) }}
		<input type="hidden" value="{{ $username }}" id="name" name="name" />
		<input type="hidden" value="{{ $code }}" id="code" name="code" />


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
		
		{{ Form::submit('Reset') }}
	{{ Form::close() }}
@stop