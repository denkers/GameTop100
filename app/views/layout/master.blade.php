<!DOCTYPE HTML>
<html lang='en-us'>
	<head>
		@section('head')
		<meta charset='utf-8' />
			{{ HTML::style('dependencies/bootstrap/boostrap.min.css'); }}
			{{ HTML::style('dependencies/bootstrap_theme.min.css'); }}
			{{ HTML::style('css/main.css'); }}
		@show

		<title>MegaTop100 - @yield('title_postfix')</title>

		@section('js')
			{{ HTML::script('dependencies/jquery.min.js'); }}
			{{ HTML::script('dependencies/bootstrap.min.js'); }}
			{{ HTML::script('javascript/main.js'); }}
			{{ HTML::script('javascript/user/user_management.js'); }}
		@show
	</head>

	<body>
		<!-- NAVIGATION -->		
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container'>
				<div class='navbar-header'>
					<a class='navbar-brand'>MegaTop100</a>
				</div>

				<div id='nav_main' class='navbar-collapse collapse'>
					<ul class='nav navbar-nav navbar-right'>

						<!-- HOME NAV BTN -->
						<li class='active'><a href='#' id='nav_home_btn'>
							<span class='glyphicon glyphicon-home'></span> Home</a>
						</li>

						<!-- RANKING NAV BTN -->
						<li>
							<a href='{{ URL::route("getRankingHome"); }}' id='nav_ranking_btn'><span class='glyphicon glyphicon-star'></span> Ranking</a>
						</li>
	
						<!-- LOGIN NAV BTN -->	
						@if(!Auth::check())
						<li>
							<a href='{{ URL::route("getLogin"); }}' id='nav_login_btn'><span class='glyphicon glyphicon-lock'></span> Login</a>
						</li>
					

						<!-- REGISTER NAV BTN 
						<li>
							<a href='{{ URL::route("getRegister"); }}' id='nav_register_btn'><span class='glyphicon glyphicon-plus'></span> Register</a>
						</li> -->
						@else
						<li>
							<a href='{{ URL::route("getRegister"); }}' id='nav_register_btn'><span class='glyphicon glyphicon-plus'></span> Register</a>
						</li>
							<li>
								<a href='#' id='nav_logout_btn'><span class='glyphicon glyphicon-signal'></span> Management</a>
							</li>

							<li>
								<a href='#' id='nav_logout_btn'><span class='glyphicon glyphicon-cog'></span> Settings</a>
							</li>

							<li>
								<a href='#' id='nav_logout_btn'><span class='glyphicon glyphicon-remove'></span> Logout</a>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>	
		@yield('content')
		
		<div class='modal fade' id='register_modal' role='dialog'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button class='close' data-dismiss='modal'>&times;</button>
						<h4 class='modal-title'>Registration</h4>
					</div>

					<div class='modal-body'>
						@include('user.register')
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
