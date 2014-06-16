@extends('layout.main')

@section('content')
<div id="create">
	<main class="container">
	<ul class="pager">
	  <li class="previous"><a href="{{ URL::route('home') }}">&larr; Back</a></li>
	</ul>
		<h3>Register Now!</h3>

		@if(Session::has('global'))
			{{ Session::get('global') }}
		@endif

		{{ Form::open(array('route' => 'account-create')) }}
					
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
						{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus')) }}
					</div>
					@if($errors->has('username'))
						<p class="alert alert-danger">{{ $errors->first('username') }}</p>
					@endif

					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
					</div>
					@if($errors->has('email'))
						<p class="alert alert-danger">{{ $errors->first('email') }}</p>
					@endif
					
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'autofocus')) }}
					</div>
					@if($errors->has('password'))
						<p class="alert alert-danger">{{ $errors->first('password') }}</p>
					@endif
					
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						{{ Form::password('password_conf', array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'autofocus')) }}
					</div>
					@if($errors->has('password_conf'))
						<p class="alert alert-danger">{{ $errors->first('password_conf') }}</p>
					@endif

					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
						{{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City', 'autofocus')) }}
					</div>
					@if($errors->has('city'))
						<p class="alert alert-danger">{{ $errors->first('city') }}</p>
					@endif

					<div class="center">
						{{ Form::label('gender', 'Gender: ') }}
						{{ Form::select('gender', array('m' => 'Male', 'f' => 'Female'), '', ['class' => 'form-control']) }}
					</div>
					
					<div class="center">
						<button class="btn btn-lg btn-success btn-block">
							<i class="fa fa-flag"></i>
							{{ Form::submit('Create Account') }}
						</button>
					</div>

				{{ Form::close() }}
		
	</main>
</div>
@stop