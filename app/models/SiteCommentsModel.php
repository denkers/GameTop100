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
}
