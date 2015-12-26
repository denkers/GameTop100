<!-- REGISTER STATUS ALERT -->
<div id='register_alert' class='alert alert-dismissable fade in'>
<strong>Register notice</strong>
<p id='register_alert_msg'></p>
</div>

<form id='register_form' method='post' action='{{ URL::route("postRegister"); }}'>

	<!-- USERNAME FIELD -->
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-2'>
				<h4>Username</h4>	
			</div>

			<div class='col-md-8'>
				<div class='input-group'>
					<span data-checkurl='{{ URL::route("postCheckUsername"); }}' class='input-group-addon' id='user_avail_addon'>Availability</span>
					<input type='text' id='username_field' class='form-control' name='register_user' placeholder='Username'
					data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Username 6-18 alphanumeric characters' />
				</div>
			</div>
		</div>
	</div>	

	<!-- PASSWORD FIELD -->
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-2'>
				<h4>Password</h4>	
			</div>

			<div class='col-md-8'>
				<div class='input-group'>
					<span class='input-group-addon' id='pass_str_ind'>Strength</span>
					<input type='password' id='pass_field' class='form-control' name='register_pass' placeholder='Password'
					data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Strong password 6-18 alphanumeric characters' />
				</div>
			</div>
		</div>
	</div>

	<!-- PASSWORD RE-ENTER FIELD -->
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-2'>
				<h4>Repeat Password</h4>	
			</div>

			<div class='col-md-8'>
				<div class='input-group'>
					<span class='input-group-addon' id='pass_match_ind'>Valid</span>
					<input type='password' id='pass_match_field' class='form-control' name='register_pass_rep' placeholder='Password'
					data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Re-enter your password' />
				</div>
			</div>
		</div>
	</div>


	<!-- EMAIL ADDRESS FIELD -->
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-2'>
				<h4>Email address</h4>	
			</div>

			<div class='col-md-8'>
				<input type='email' class='form-control' name='register_email' placeholder='Email'
				data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Valid email address to confirm registration' />
			</div>
		</div>
	</div>

	<div class='register_controls btn-group'>
		<button class='btn btn-default' id='register_cancel_btn'>Cancel</button>
		<button class='btn btn-success' id='register_submit_btn'>Register</button>
	</div>
</form>
