<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	SiteCommentsModel
//==================================

class SiteCommentsModel extends Eloquent
{
	protected $table = 'site_comments';

	public function userVotes()
	{
		return $this->hasMany('CommentVotesModel', 'comment_id');
	}

	public static function getCommentsForSite($site_id)
	{
		return self::where('site_id', '=', $site_id)->orderBy('created_at', 'desc')
			->with(['userVotes', function($query)
			{
				$query->where('comment_votes.user_id', '=', Auth::user()->username);
			}])->get();
	}
}
