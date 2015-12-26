<?php

class SitesModel extends Eloquent
{
	protected $table = 'sites';

	public function games()
	{
		return $this->belongsTo('GamesModel', 'game_id');
	}

	public static function getSitesForGame($game_id)
	{
		return self::where('game_id', '=', $game_id)->get();
	}
	
	public static function getSitesForUser($user_id)
	{
		return self::where('owner', '=', $user_id);
	}	
}
