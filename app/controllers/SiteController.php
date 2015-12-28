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
			's_id'	=>	'required|exists:sites,id'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$site		=	SitesModel::find(Input::get('s_id'));	
			
			if($site->delete())
				return MasterController::encodeReturn(true, $success_message);
			else
				return MasterController::encodeReturn(false, $fail_message);
		}
	}

	public function postEditSite()
	{
		$success_msg	=	'Successfully edited site';
		$fail_msg		=	'Failed to edit site';

		$validator		=	Validator::make(Input::all(),
		[
			's_id'		=>	'required|exists:sites,id',
			's_title'	=>	'required|max:30',
			's_desc'	=>	'required|max:120',
			's_add'		=>	'required'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$site				=	SitesModel::find(Input::get('s_id'));
			$site->title		=	Input::get('s_title');
			$site->description	=	Input::get('s_desc');
			$site->address		=	Input::get('s_add');

			if($site->save())
				return MasterController::encodeReturn(true, $success_msg);
			else
				return MasterController::encodeReturn(false, $fail_msg);		
		}
	}

	public function getMySites()
	{
		$site_list	=	$this->getMySiteList();
		return View::make('user.sites')->with('site_list', $site_list);
	}

	public function getSite()
	{
		$site_id	=	Route::current()->getParameter('site_id');
		return SitesModel::where('id', '=', $site_id)->with('games')->first();	
	}

	public function getMySiteList()
	{
		$site_list	=	SitesModel::getSitesForUser(Auth::user()->username)
						->orderBy('title')
						->get();

		return $site_list;
	}

	public function getSiteVote()
	{
		$site_id	=	Route::current()->parameters['site_id'];
		return View::make('ranking.site_vote');
	}

	public function postSiteVote()
	{

	}

	public function getSiteComments()
	{
		$site_id	=	Route::current()->getParameter('site_id');
	}

	public function postAddSiteComment()
	{
		$success_msg	=	'Successfully added comment';
		$fail_msg		=	'Failed to add comment';

		$validator		=	Validator::make(Input::all(), 
		[
			'comment_content'	=>	'required|max:300',
			'comment_site'		=>	'required|exists:sites,id'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$comment				=	new SiteCommentsModel();
			$comment->site_id		=	Input::get('comment_site');
			$comment->writter_id	=	Auth::user()->username;
			$comment->content		=	Input::get('comment_content');

			if($comment->save())
				return MasterController::encodeReturn(true, $success_msg);
			else
				return MasterController::encodeReturn(false, $fail_msg);
		}
	}

	public function postVoteComment()
	{
		
	}

	private function userCanComment($commentModel)
	{
		$user	=	Auth::user();
		return $commentModel->writter_id == $user->username || $user->isAdmin;
	}

	public function postEditComment()
	{
		$success_msg		=	'Successfully edited comment';
		$fail_msg			=	'Failed to edit comment';

		$validator			=	Validator::make(Input::all(),
		[
			'comment_id'		=>	'required|exists:site_comments,id',
			'comment_content'	=>	'required|max:300',
			'comment_rating'	=>	'required|max:5'
		]);
		
		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$comment					=	SiteCommentsModel::find(Input::get('comment_id'));

			if(!$this->userCanComment($comment))
				return MasterController::encodeReturn(false, $fail_msg);

			$comment->content			=	Input::get('comment_content');
			$comment->comment_rating	=	Input::get('comment_rating');

			if($comment->save())
				return MasterController::encodeReturn(true, $success_msg);
			else
				return MasterController::encodeReturn(false, $fail_msg);
		}
	}

	public function postRemoveComment()
	{
		$success_msg		=	'Successfully removed comment';
		$fail_msg			=	'Failed to remove comment';
		
		$validator			=	Validator::make(Input::all(),
		[
			'comment_id'	=>	'required|exists:site_comments,id'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$comment		=	SiteCommentsModel::find(Input::get('comment_id'));
			if(!$this->userCanComment($comment))
				return MasterController::encodeReturn(false, $fail_msg);

			else
			{
				if($comment->delete())
					return MasterController::encodeReturn(true, $success_msg);
				else
					return MasterController::encodeReturn(false, $fail_msg);
			}
		}
	}

	public function postReportComment()
	{

	}
}
