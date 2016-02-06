<div class='modal-header'>
	<button class='close' data-ng-click='$root.closeModal()'>&times;</button>
	<h4 class='modal-title'>Register</h4>
</div>

<div class='modal-body'>
	<!-- REGISTER STATUS ALERT -->
	<uib-alert data-ng-show='registerResponse' close='registerResponse = null' 
	type='<% registerResponse.status? "success" : "danger" %>'>
		<span class='<% registerResponse.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
			<% registerResponse.message %>
	</uib-alert>

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
						<input type='text' id='username_field' class='form-control' name='register_user' placeholder='Username'					data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Username 6-18 alphanumeric characters' data-ng-model='registerData.username'/>
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
						<input type='password' id='pass_field' class='form-control' name='register_pass' placeholder='Password' data-ng-model='registerData.password' data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Strong password 6-18 alphanumeric characters' />
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
					data-toggle='tooltip' data-placement='right' data-trigger='focus' data-title='Valid email address to confirm registration' data-ng-model='registerData.email'/>
				</div>
			</div>
		</div>

		
		<center>
			<div vc-recaptcha key="$root.siteKey"></div>
		</center>

		<br>
		<div class='register_controls btn-group'>
			<button class='btn btn-default' id='register_cancel_btn' data-ng-click='$root.closeModal(); $event.preventDefault()'>Cancel</button>
			<button class='btn btn-success' id='register_submit_btn' data-ng-click='register(); $event.preventDefault()'>Register</button>
		</div>
	</form>
</div>
