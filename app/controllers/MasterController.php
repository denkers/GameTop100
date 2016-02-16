<?php 
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	MasterController
//==================================


class MasterController extends Controller
{
	protected $invalid_input_msg	=	'Invalid input, please check fields';

	public static function encodeReturn($status = 0, $message = 'Request failed', $data = null)
	{
		$return_message	=	['status'	=>	$status, 'message' =>	$message];

		if(isset($data))
		{
			foreach($data as $key => $value)
				$return_message[$key] = $value;
		}

		return json_encode($return_message);
	}

	public static function encodeReturnMessage($result, $success_msg, $fail_msg, $success_data = [])
	{
		if($result)
			return MasterController::encodeReturn(true, $success_msg, $success_data);
		else
			return MasterController::encodeReturn(false, $fail_msg);		
	}

	public function getHome()
	{
		return View::make('home');
	}	

	public function getError()
	{
		return View::make('error');
	}

	public static function getRobotValidator($response, $ip = null)
	{
		$secret			=	Config::get('app-utils.captchaSecret');
		$captcha		=	new \ReCaptcha\ReCaptcha($secret);
		$clientIP		=	isset($ip)? $ip : Request::getClientIp();
		$cValidator		=	$captcha->verify($response, $clientIP);

		return $cValidator;
	}
}
