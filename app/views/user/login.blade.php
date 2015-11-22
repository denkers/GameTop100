@extends('layout.master')

@section('title_postfix')
Login
@stop

@section('js')
	{{ HTML::script('javascript/user/user_management.js'); }} 
@stop

@section('content')
	<div class='container'>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>Login</h3>
			</div>

			<div class='panel-body login_body'>
		
				<!-- LOGIN STATUS ALERT -->
				<div id='login_alert' class='alert alert-dismissable fade in'>
					<strong>Login notice</strong>
					<p id='login_alert_msg'></p>
				</div>
				
				<!-- LOGIN FORM -->
				<form id='login_form' method='post' action=''>
		
					<!-- USERNAME FIELD -->
					<div class='form-group'>
						<div class='input-group'>
							<span class='input-group-addon'><span class='glyphicon glyphicon-user'></span></span>
							<input type='text' id='username_field' class='form-control' 
							name='login_username' placeholder='Enter your username'/>
						</div>
					</div>	

					<!-- PASSWORD FIELD -->
					<div class='form-group'>
						<div class='input-group'>
							<span class='input-group-addon'><span class='glyphicon glyphicon-lock'></span></span>
							<input type='password' id='password_field' class='form-control'
							name='login_password' placeholder='Enter your password' />
						</div>
					</div>

					<div id='login_controls'>
						<div class='btn-group'>
							<button class='btn btn-default' id='forgot_btn'>Forgot password</button>
							<button class='btn btn-primary' id='login_btn'>Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
