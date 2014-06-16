<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">

		<div class="navbar-header">
			
			<img src="{{ URL::asset('img/logo.png') }}" alt="logo">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
	        </button>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
						{{ Auth::user()->username }}
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{ URL::route('account-update-settings') }} "><i class="fa fa-cog fa-spin fa-fw"></i>Change settings</a></li>
						<li><a href="{{ URL::route('account-logout') }} "><i class="fa fa-power-off fa-fw"></i>Log Out</a></li>
	                </ul>

					
					
				</li>
				<li><a href="{{ URL::route('profile') }}"><i class="fa fa-home fa-fw"></i>Profile</a></li>
				<li><a href="{{ URL::route('shelf') }} "><i class="fa fa-cutlery fa-fw"></i>Shelf</a></li>
				<li><a href="{{ URL::route('smart-list') }} "><i class="fa fa-shopping-cart fa-fw"></i>Smart List</a></li>
				
			</ul>
		</div>
	</div>
</nav>