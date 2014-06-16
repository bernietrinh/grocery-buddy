@extends('layout.main')

@section('content')
<div id="update-settings">
	<main class="container">

		<ul class="pager">
		  <li class="previous"><a href="{{ URL::route('profile') }}">&larr; Back</a></li>
		</ul>

		{{ Form::model($user, array('url' => 'account/update-settings', $user->id)) }}
			<h3>Update your Personal Settings</h3>

			@if(Session::has('global'))
			{{ Session::get('global') }}
			@endif

			{{ Form::label('username', 'Username:') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
				{{ Form::text('username', null, array('class' => 'form-control')) }}
			</div>

			{{ Form::label('new_password', 'New Password: ') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			{{ Form::password('new_password', array('class' => 'form-control', 'placeholder' => 'New Password')) }}
			</div>
			@if($errors->has('new_password'))
				<p class="alert alert-danger">{{ $errors->first('new_password') }}</p>
			@endif

			{{ Form::label('new_password_conf', 'Confirm Password: ') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
				{{ Form::password('new_password_conf', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
			</div>
				@if($errors->has('new_password_conf'))
					<p class="alert alert-danger">{{ $errors->first('new_password_conf') }}</p>
				@endif

			{{ Form::label('password', 'Password: ') }}
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Old Password')) }}
			</div>
				@if($errors->has('password'))
					<p class="alert alert-danger">{{ $errors->first('password') }}</p>
				@endif

			<div class="center">
			<button class="btn btn-info">
				<i class="fa fa-floppy-o fa-lg"></i>
				{{ Form::submit('Update') }}
			</button>
			</div>
		{{ Form::close() }}
	</main>
</div>
@stop