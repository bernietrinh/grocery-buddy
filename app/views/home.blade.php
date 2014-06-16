@extends('layout.main')

@section ('custom_css')

<link rel="stylesheet" href="{{ URL::asset('css/onepage-scroll.css') }}" type="text/css">
@stop
@section('content')
	
<div class="container" id="home">

	<section>
	<article>
		<img src="{{ URL::asset('img/logo.png') }}" alt="Logo">
		{{ Form::open(array('route' => 'account-login')) }}
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
				{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus')) }}
			</div>
			@if($errors->has('username'))
				<p class="alert alert-danger">{{ $errors->first('username') }}</p>
			@endif
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'autofocus')) }}
			</div>
			@if($errors->has('password'))
				<p class="alert alert-danger">{{ $errors->first('password') }}</p>
			@endif

			{{ Form::label('remember', 'Remember Me')}}
			{{ Form::checkbox('remember', 'remember') }}
		
		<div class="center">
			<button class="btn btn-success btn-md">
				<i class="fa fa-cutlery"></i>
				{{ Form::submit('Login') }}
			</button>
		</div>
		
		<a href="{{ URL::route('account-forgot') }}">Forgot your password?</a>
		<a href="{{ URL::route('account-create') }}">Create an Account</a>
		{{ Form::close() }}

		@if(Session::has('global'))
		{{ Session::get('global') }}
		@endif
	</article>
	</section>

	<section>
	<article id="home_article_two">
		<h3>Add groceries items to your Shelf...</h3>
		<p>separate them from your fridge, freezer, or pantry and track information such as purchase and expiry date, price, and location.</p>
		<img src="{{ URL::asset('img/wheat.png') }}" alt="wheat">
		<img src="{{ URL::asset('img/fish.png') }}" alt="fish">
		<img src="{{ URL::asset('img/beverage.png') }}" alt="beverage">
	</section>
	</article>

	<section>
	<article id="home_article_three">
		<h3>Keep track of your perishable items as they appoach their expiry dates...</h3>
		<p>with delicious recipe suggestions based on what is expiring soon.</p>
		<div>
			<img src="{{ URL::asset('img/meat.png') }}" alt="meat">
			<img src="{{ URL::asset('img/veggies.png') }}" alt="veggies">
		</div>
		<img src="{{ URL::asset('img/fridge.png') }}" alt="fridge">
		<img src="{{ URL::asset('img/arrow.png') }}" alt="arrow">
	</article>
	</section>

	<section>
	<article id="home_article_four">
		<h3>Create Smart Shopping Lists...</h3>
		<p>know the date, price, and location of when you last purchased your items.</p>
		<img src="{{ URL::asset('img/cart.png') }}" alt="cart">
	</article>
	</section>

	<section>
	<article id="home_article_five">
		<h3>Register Now!</h3>
		{{ Form::open(array('route' => 'account-create')) }}
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
				{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username', 'autofocus')) }}
			</div>

			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
				{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
			</div>
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'autofocus')) }}
			</div>
			
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
				{{ Form::password('password_conf', array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'autofocus')) }}
			</div>

			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
				{{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City', 'autofocus')) }}
			</div>

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
	</article>
	</section>

</div>

@stop

@section('custom_scripts')
<script src="{{asset('js/jquery.onepage-scroll.js')}}"></script>

<script>
$(document).ready(function() {
	$("#home").onepage_scroll({
	   sectionContainer: "section", 
	   easing: "ease",
	   animationTime: 1000,
	   pagination: false,
	   updateURL: false
	});
});

</script>

@stop
