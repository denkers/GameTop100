<div class='modal-header'>
	<button class='close' data-ng-click='$root.closeModal()'>&times;</button>
	<h4 class='modal-title'>Sign-in</h4>
</div>

<div class='modal-body'>
<!-- LOGIN STATUS ALERT -->
<div id='login_alert' class='alert alert-dismissable fade in'>
	<strong>Login notice</strong>
	<p id='login_alert_msg'></p>
</div>

<!-- LOGIN FORM -->
<form id='login_form'> 

	<!-- USERNAME FIELD -->
	<div class='form-group'>
		<div class='input-group'>
			<span class='input-group-addon'><span class='glyphicon glyphicon-user'></span></span>
			<input type='text' id='username_field' class='form-control' 
			name='login_id' placeholder='Enter your username'
			data-ng-model='loginData.username'/>
		</div>
	</div>	

	<!-- PASSWORD FIELD -->
	<div class='form-group'>
		<div class='input-group'>
			<span class='input-group-addon'><span class='glyphicon glyphicon-lock'></span></span>
			<input type='password' id='password_field' class='form-control'
			name='login_pass' placeholder='Enter your password'
			data-ng-model='loginData.password' />
		</div>
	</div>

	<!-- REMEMBER FIELD -->
	<div class='form-group'>
		<div class='checkbox'>
			<label><input type='checkbox' name='login_remember' data-ng-model='loginData.remember'>Remember me</label>
		</div>
	</div>

	<div id='login_controls'>
		<div class='btn-group'>
			<button class='btn btn-default' id='forgot_btn'>Forgot password</button>
			<button class='btn btn-primary' id='login_btn' data-ng-click='login(); $event.preventDefault();'>Login</button>
		</div>
	</div>
</form>
</div>

