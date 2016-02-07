<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	SitesModel	
//==================================


class SitesModel extends Eloquent
{
	protected $table = 'sites';

	public function games()
	{
		return $this->belongsTo('GamesModel', 'game_id');
	}

	public function comments()
	{
		return $this->hasMany('SiteCommentsModel', 'site_id');
	}

	public function votes()
	{
		return $this->hasMany('SiteVotesModel', 'site_id');
	}

	public static function getSitesForGame($game_id)
	{
		return self::getSitesWithComments()->where('game_id', '=', $game_id);
	}

	public static function getSite($site_id)
	{
		return self::getSitesWithComments()->where('id', '=', $site_id);
	}

	public static function getSitesWithComments()
	{
		return self::with(['comments' => function ($query)
		{
			$query->orderBy('comments.comment_rating');
		}])
		->with(['comments.userVotes' => function($query)
		{
			if(Auth::check())
				$query->where('comment_votes.user_id', '=', Auth::user()->username);
		}])
		->with(['votes' => function($query)
		{
			$query->selectRaw('id, site_id, isOut, COUNT(*) as num_votes');
			$query->groupBy('isOut');
		}]);
	}
	
	public static function getSitesForUser($user_id)
	{
		return self::where('owner', '=', $user_id);
	}	
}
