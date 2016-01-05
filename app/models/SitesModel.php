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
		return self::where('game_id', '=', $game_id)->with('comments');
	}
	
	public static function getSitesForUser($user_id)
	{
		return self::where('owner', '=', $user_id);
	}	
}
