<nav>
	<ul>
		<li><a href="{{ URL::route('home') }}">Home</a></li>
		@if (Auth::check())
			<li><a href="{{ URL::route('account-logout') }} ">Log Out</a></li>
			<li><a href="{{ URL::route('account-update-settings') }} ">Change settings</a></li>
			<li><a href="{{ URL::route('smart-list') }} ">Smart List</a></li>
		@else
		<li><a href="{{ URL::route('account-login') }}">Log In</a></li->
		<li><a href="{{ URL::route('account-create') }}">Create an Account</a></li>
		@endif
	</ul>
</nav>