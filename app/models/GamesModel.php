<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	GamesModel	
//==================================


class GamesModel extends Eloquent
{
	protected $table = 'games';

	public static function getGames()
	{
		return self::orderBy('name')->get();
	}
}
