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

	public function getHome()
	{
		return View::make('home');
	}	

	public function getError()
	{
		return View::make('error');
	}

	public function postRobotVerify()
	{
		return json_encode(Input::all());		
	}
}
