<!DOCTYPE HTML>
<html lang='en-us' data-ng-app='main'>
	<head>
		@section('head')
		<meta charset='utf-8' />
			{{ HTML::style('dependencies/bootstrap/boostrap.min.css'); }}
			{{ HTML::style('dependencies/bootstrap_theme.min.css'); }}
			{{ HTML::style('css/main.css'); }}
		@show

		<title>MegaTop100 - @yield('title_postfix')</title>

		@section('js')
			{{ HTML::script('dependencies/angular.js'); }}
			{{ HTML::script('dependencies/ui-bootstrap-tpls.min.js'); }}
			{{ HTML::script('javascript/modules/app.js'); }}
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

						<? 
							$auth_user		=	Auth::check(); 
							$guest_class	=	$auth_user? 'hide' : '';
							$auth_class		=	!$auth_user? 'hide' : '';	
						?>

						<!-- LOGIN NAV BTN -->	
						<li class='guest_nav {{ $guest_class }}'>
							<a href='{{ URL::route("getLogin"); }}' id='nav_login_btn'><span class='glyphicon glyphicon-lock'></span> Login</a>
						</li>
						
						<!-- REGISTER NAV BTN -->
						<li class='guest_nav {{ $guest_class }}'>
							<a href='{{ URL::route("getRegister"); }}' id='nav_register_btn'><span class='glyphicon glyphicon-plus'></span> Register</a>
						</li>

							<!-- MANAGEMENT NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a href='{{ URL::route("getMySites"); }}' id='nav_management_btn'><span class='glyphicon glyphicon-signal'></span> Management</a>
							</li>

							<!-- SETTINS NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a href='{{ URL::route("getUserSettings"); }}' id='nav_settings_btn'><span class='glyphicon glyphicon-cog'></span> Settings</a>
							</li>

							<!-- LOGOUT NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a href='{{ URL::route("getLogout"); }}' id='nav_logout_btn'><span class='glyphicon glyphicon-remove'></span> Logout</a>
							</li>	
					</ul>
				</div>
			</div>
		</nav>	
		@yield('content')

		<div class='modal fade' id='logout_modal' role='dialog'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-body'>
						<h3 class='logout_modal_message'>Please wait one moment</h3>
					</div>
				</div>
			</div>
		</div>
		
		<div class='modal fade' id='register_modal' role='dialog'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button class='close' data-dismiss='modal'>&times;</button>
						<h4 class='modal-title'>Registration
							<br><small>Create your MegaTop100 account</small>
						</h4>
					</div>

					<div class='modal-body'>
						@include('user.register')
					</div>
				</div>
			</div>
		</div>

		<div class='modal fade' id='login_modal' role='dialog'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button class='close' data-dismiss='modal'>&times;</button>
						<h4 class='modal-title'>Sign-in
							<br><small>Enter your MegaTop100 account credentials</small>
						</h4>
					</div>

					<div class='modal-body'>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
