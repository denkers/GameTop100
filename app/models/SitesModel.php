<?php

class SitesModel extends Eloquent
{
	protected $table = 'sites';

	public static function getSitesForGame($game_id)
	{
		return self::where('game_id', '=', $game_id)->get();
	}	
}
