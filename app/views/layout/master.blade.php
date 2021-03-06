<!DOCTYPE HTML>
<html lang='en-us' data-ng-app='main'>
	<head>
		@section('head')
		<meta charset='utf-8' />
			{{ HTML::style('dependencies/bootstrap.min.css'); }}
			{{ HTML::style('dependencies/bootstrap_theme.min.css'); }}
			{{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); }}
			{{ HTML::style('css/main.css'); }}
		@show

		<title>MegaTop100 - @yield('title_postfix')</title>

		@section('js')
		<script>
			var root_url	=	'{{ URL::to("/"); }}';
		</script>

			{{ HTML::script('dependencies/angular.js'); }}
			{{ HTML::script('dependencies/angular-animate.min.js'); }}
			{{ HTML::script('dependencies/angular-recaptcha.min.js'); }}
			{{ HTML::script('dependencies/moment.js'); }}
			{{ HTML::script('https://www.google.com/recaptcha/api.js?onload=vcRecaptchaApiLoaded&render=explicit', 
			['async', 'defer']); }}
			{{ HTML::script('dependencies/ui-bootstrap-tpls.min.js'); }}
			{{ HTML::script('javascript/modules/app.js'); }}
			{{ HTML::script('javascript/directives/message-modal-directive.js'); }}
			{{ HTML::script('javascript/controllers/user-controller.js'); }}
			{{ HTML::script('javascript/controllers/nav-controller.js'); }}
		@show
	</head>

	<body>
		<!-- NAVIGATION -->		
		<nav class='navbar navbar-inverse navbar-fixed-top' data-ng-controller='navController'>
			<div class='container'>
				<div class='navbar-header'>
					<a class='navbar-brand'>MegaTop100</a>
				</div>

				<div id='nav_main' class='navbar-collapse collapse'>
					<ul class='nav navbar-nav navbar-right'>

						<!-- HOME NAV BTN -->
						<li>
							<a class='nav-link' href='{{ URL::route("getRankingHome"); }}' id='nav_ranking_btn'><span class='glyphicon glyphicon-home'></span> Home</a>
						</li>

						<?php 
							$auth_user		=	Auth::check(); 
							$guest_class	=	$auth_user? 'hide' : '';
							$auth_class		=	!$auth_user? 'hide' : '';	
						?>

						<!-- LOGIN NAV BTN -->	
						<li class='guest_nav {{ $guest_class }}'>
							<a class='nav-link' href='' data-ng-click='openLogin(); $event.preventDefault()' id='nav_login_btn'><span class='glyphicon glyphicon-lock'></span> Login</a>
						</li>
						
						<!-- REGISTER NAV BTN -->
						<li class='guest_nav {{ $guest_class }}'>
							<a class='nav-link' href='{{ URL::route("getRegister"); }}' data-ng-click='openRegister(); $event.preventDefault()' id='nav_register_btn'><span class='glyphicon glyphicon-plus'></span> Register</a>
						</li>

							<!-- MANAGEMENT NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a class='nav-link' href='{{ URL::route("getMySites"); }}' id='nav_management_btn'><span class='glyphicon glyphicon-signal'></span> Management</a>
							</li>

							<!-- SETTINS NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a class='nav-link' href='{{ URL::route("getUserSettings"); }}' id='nav_settings_btn'><span class='glyphicon glyphicon-cog'></span> Settings</a>
							</li>

							<!-- LOGOUT NAV -->
							<li class='auth_nav {{ $auth_class }}'>
								<a class='nav-link' href='' data-ng-click='openLogout(); $event.preventDefault()' id='nav_logout_btn'><span class='glyphicon glyphicon-remove'></span> Logout</a>
							</li>	
					</ul>
				</div>
			</div>
		</nav>

		<div id='content-container'>
			@yield('content')
		</div>

		<footer id='main-footer'> 
			@include('layout.footer')
		</footer>
	</body>
</html>
