<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	CommentVotesModel	
//==================================


class CommentVotesModel extends Eloquent
{
	protected $table	=	'comment_votes';

	public static function getUserVote($comment_id, $user)
	{
		return self::where('user_id', '=', $user)
					->where('comment_id', '=', $comment_id)
					->first();
	}
}
