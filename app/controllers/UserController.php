<?php

class UserController extends MasterController
{
	public function postLogin()
	{
		$success_message	=	'Successfully logged in';
		$fail_message		=	'Failed to login, invalid username/password';

		$validator = Validator::make(Input::all(), 
		[
			'username'		=>	'required|exists:users,username',
			'password'		=>	'required|max:16'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$user_id		=	Input::get('username');
			$user_pass		=	Input::get('password');
			$remember_user	=	Input::has('remember');
			$attempt		=	Auth::attempt
			([
				'username'	=>	$user_id,
				'password'	=>	$user_pass
			], $remember_user);

			if($attempt)
				return MasterController::encodeReturn(true, $success_message);
			else
				return MasterController::encodeReturn(false, $fail_message);
		}
	}

	
	public function getRegister()
	{
		return View::make('user.register');
	}


	public function postRegister()
	{
		$success_message	=	'Registration successful, you may now login';
		$fail_message		=	'Failed to register';
		$user_exists		=	'Username already exists';

		$validator			=	Validator::make(Input::all(),
		[
			'username'		=>	'required|min:4|max:18',
			'password'		=>	'required|min:6|max:18',
			'email'			=>	'required|email'
		]);
		
		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$reg_username	=	Input::get('username');
			$reg_pass		=	Input::get('password');
			$reg_email		=	Input::get('email');

			if(User::where('username', '=', $reg_username)->exists())
				return MasterController::encodeReturn(false, $user_exists);
			else
			{	
				$user			=	new User();
				$user->username	=	$reg_username;
				$user->password	=	Hash::make($reg_pass);
				$user->email	=	$reg_email;

				if($user->save())
					return MasterController::encodeReturn(true, $success_message);
				else
					return MasterController::encodeReturn(false, $fail_message);	
			}		
		}
	}	

	public function getProfile($user)
	{
		return View::make('user.profile');
	}

	public function getUserSettings()
	{
		return View::make('user.settings');	
	}

	public function postCheckUsername()
	{
		$avail_msg			=	'Username is available';
		$unavail_msg		=	'Username is taken';

		$validator			=	Validator::make(Input::all(),
		[	
			'username_req'	=>	'required'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			if(User::where('username', '=', Input::get('username_req'))->exists())
				return MasterController::encodeReturn(false, $unavail_msg);
			else
				return MasterController::encodeReturn(true, $avail_msg);
		}
	}

	public function getLogout()
	{
		$success_msg	=	'Successfully logged out';

		Auth::logout();
		return MasterController::encodeReturn(true, $success_msg);
	}
}
