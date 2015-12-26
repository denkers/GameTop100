<?php

class GamesModel extends Eloquent
{
	protected $table = 'games';

	public static function getGames()
	{
		return self::orderBy('name')->get();
	}
}
