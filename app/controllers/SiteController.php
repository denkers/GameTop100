<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	SiteController
//==================================

class SiteController extends MasterController
{
	public function postAddSite()
	{
		$success_message	=	'Successfully added site';
		$fail_message		=	'Failed to add site';

		$validator			=	Validator::make(Input::all(),
		[
			's_title'	=>	'required|min:5|max:30',
			's_desc'	=>	'required|min:10|max:200',
			's_add'		=>	'required',
			's_game'	=>	'required|exists:games,id'
		]);	

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$site				=	new SitesModel();
			$site->title		=	Input::get('s_title');
			$site->description	=	Input::get('s_desc');
			$site->address		=	Input::get('s_add');
			$site->game_id		=	Input::get('s_game');
			$site->owner		=	Auth::user()->username;	

			if($site->save())
				return MasterController::encodeReturn(true, $success_message, ['addedSite' => $site]);
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
				return MasterController::encodeReturn(true, $success_msg, ['saved_site' => $site]);
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

	public function getSiteVoteCheck()
	{
		$site_id	=	Route::current()->getParameter('site_id');
		$dateFormat	=	'Y-m-d h:i:s';
		$prev_vote	=	SiteVotesModel::getRecentVoteForSite($site_id)->select('created_at')->get()->first();

		if($prev_vote != null)
		{
			$prev_vote	=	new DateTime($prev_vote['created_at']->toDateTimeString());
			$prev_vote	=	$prev_vote->format($dateFormat);
		}

		$current	=	new DateTime(null, new DateTimeZone('NZ'));
		$current	=	$current->format($dateFormat);

		return json_encode(['current_time' => $current, 'voter_time' => $prev_vote]);
	}

	public function getSiteVote()
	{
		$site_id	=	Route::current()->getParameter('site_id');	
		$site		=	json_encode(SitesModel::getSite($site_id)->first());
		$vote_times	=	$this->getSiteVoteCheck();

		return View::make('ranking.site_vote')
				->with('site_data', $site)
				->with('recent_vote', $vote_times);
	}

	public function postSiteVote()
	{
		$success_msg	=	'You have successfully voted';
		$robot_msg		=	'Invalid chaptcha response';
		$fail_msg		=	'Failed to add vote';
		$vote_exist_msg	=	'You have already voted within 12 hours';

		$validator		=	Validator::make(Input::all(),
		[
			'site-id'				=>	'required|exists:sites,id',
			'g-captcha-response'	=>	'required'
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$response		=	Input::get('g-captcha-response');
			$cValidator		=	MasterController::getRobotValidator($response);

			if($cValidator->isSuccess())
			{
				$site			=	Input::get('site-id');
				if(SiteVotesModel::getRecentVoteForSite($site)->exists())
					return MasterController::encodeReturn(false, $vote_exist_msg);

				$vote			=	new SiteVotesModel();
				$vote->site_id	=	$site;
				$vote->ip		=	Request::getClientIp();

				if($vote->save())
					return MasterController::encodeReturn(true, $success_msg);
				else
					return MasterController::encodeReturn(false, $fail_msg);	
			}

			else return MasterController::encodeReturn(false, $robot_msg);
		}
	}

	public function postOutSiteVote()
	{
		$success_msg	=	'Successfully added outgoing vote';
		$fail_msg		=	'Failed to add outgoing vote';

		$validator		=	Validator::make(Input::all(),
		[
			'site-id'	=>	'required|exists:sites,id',
		]);

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);

		else
		{
			$vote			=	new SiteVotesModel();
			$vote->site_id	=	Input::get('site-id');
			$vote->ip		=	Request::getClientIp();

			if($vote->save())
				return masterController::encodeReturn(true, $success_msg);
			else
				return MasterController::encodeReturn(false, $fail_msg);
		}
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
				return MasterController::encodeReturn(true, $success_msg, ['comment_data' => $comment]);
			else
				return MasterController::encodeReturn(false, $fail_msg);
		}
	}

	public function postRateComment()
	{
		$success_msg	=	'Successfully rated comment';
		$fail_msg		=	'Failed to rate comment';

		$validator		=	Validator::make(Input::all(),
		[
			'comment_id'	=>	'required|exists:site_comments,id',
			'is_upvote'		=>	'required'
		]);	

		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$isUpvote					=	Input::get('is_upvote') == 'true';
			$comment_id					=	Input::get('comment_id');
			$user						=	Auth::user()->username;
			$vote						=	CommentVotesModel::getUserVote($comment_id, $user);
			$comment					=	SiteCommentsModel::find($comment_id);

			if(count($vote) && $vote->isUpvote == $isUpvote)
				$comment->comment_rating	=	($isUpvote)? $comment->comment_rating - 1 : $comment->comment_rating + 1;
			else		
				$comment->comment_rating	=	($isUpvote)? $comment->comment_rating + 1 : $comment->comment_rating - 1; 

			//Vote exists, change or delete existing vote
			if(count($vote))
			{
				//same vote choice, delete users vote
				if($vote->isUpvote == $isUpvote)
				{
					if($vote->delete() && $comment->save())
						return MasterController::encodeReturn(true, $success_msg);
					else
						return MasterController::encodeReturn(false, $fail_msg);
				}

				//different vote choice, change vote
				else
				{
					$vote->isUpvote	=	$isUpvote;
					if($vote->save() && $comment->save())
						return MasterController::encodeReturn(true, $success_msg); 
					else
						return MasterController::encodeReturn(false, $fail_msg);
				}
			}

			//Create new vote
			else
			{
				$vote				=	new CommentVotesModel();
				$vote->comment_id	=	$comment_id;
				$vote->user_id		=	$user;
				$vote->isUpvote		=	$isUpvote;

				if($vote->save() && $comment->save())
					return MasterController::encodeReturn(true, $success_msg, ['added_vote' => $vote]);
				else
					return MasterController::encodeReturn(false, $fail_msg);
			}
		}
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
		]);
		
		if($validator->fails())
			return MasterController::encodeReturn(false, $this->invalid_input_msg);
		else
		{
			$comment					=	SiteCommentsModel::find(Input::get('comment_id'));

			if(!$this->userCanComment($comment))
				return MasterController::encodeReturn(false, $fail_msg);

			$comment->content			=	Input::get('comment_content');

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

	public function getRankingSiteList()
	{
		return SitesModel::getSitesWithComments()->orderBy('title')->get();
	}

	public function getRankingHome()
	{
		return View::make('ranking.home');
	}		

}
