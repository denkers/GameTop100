<?php

class SiteController extends MasterController
{
	public function postAddSite()
	{
		$success_message	=	'Successfully added site';
		$fail_message		=	'Failed to add site';

		$validator			=	Validator::make(Input::all(),
		[
			'site_title'	=>	'required|min:5|max:30',
			'site_desc'		=>	'required|min:10|max:200',
			'site_address'	=>	'required',
			'site_owner'	=>	'required|exists:users,username'
		]);	

		if($validator->fails())
			return MasterController::encodeReturn(false, $invalid_input_msg);
		else
		{
			$site				=	new SitesModel();
			$site->title		=	Input::get('site_title');
			$site->description	=	Input::get('site_desc');
			$site->address		=	Input::get('site_address');
			$site->owner		=	Input::get('site_owner');

			if($site->save())
				return MasterController::encodeReturn(true, $success_message);
			else
				return MasterController::encodeReturn(false, $fail_message);
		}
	}

	public function postRemoveSite()
	{
		$success_message	=	'Successfully removed site';
		$fail_message		=	'Failed to remove site';

		$validator			=	Validator::make(Input::all(),
		[
			'site_id'	=>	'required|exists:sites,id'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $invalid_input_msg);
		else
		{
			$site		=	SitesModel::find(Input::get('site_id'));	
			
			if($site->delete())
				return MasterController::encodeReturn(true, $success_message);
			else
				return MasterController::encodeReturn(false, $fail_message);
		}
	}

	public function postEditSite()
	{

	}

	public function getMySites()
	{
		return View::make('user.sites');
	}

	public function getSiteVote()
	{
		$site_id	=	Route::current()->parameters['site_id'];
		return View::make('ranking.site_vote');
	}

	public function postSiteVote()
	{

	}

	
}
