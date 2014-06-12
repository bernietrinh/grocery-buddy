@extends('layout.main')

@section('content')
	
	<section class="container">
		<h3>Register Now!</h3>

		@if(Session::has('global'))
			{{ Session::get('global') }}
		@endif

		{{ Form::open(array('route' => 'account-create')) }}
					
			{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus')) }}
			@if($errors->has('username'))
				<p class="alert alert-danger">{{ $errors->first('username') }}</p>
			@endif

			{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
			@if($errors->has('email'))
				<p class="alert alert-danger">{{ $errors->first('email') }}</p>
			@endif
			
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'autofocus')) }}
			@if($errors->has('password'))
				<p class="alert alert-danger">{{ $errors->first('password') }}</p>
			@endif
			
			{{ Form::password('password_conf', array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'autofocus')) }}
			@if($errors->has('password_conf'))
				<p class="alert alert-danger">{{ 'Verify your password.' }}</p>
			@endif

			{{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City', 'autofocus')) }}
			@if($errors->has('city'))
				<p class="alert alert-danger">{{ $errors->first('city') }}</p>
			@endif

			{{ Form::label('gender', 'Gender: ') }}
			{{ Form::select('gender', array('m' => 'Male', 'f' => 'Female')) }}
			
			{{ Form::submit('Create Account', array('class' => 'btn btn-lg btn-success btn-block')) }}

		{{ Form::close() }}
		
	</div>

@stop