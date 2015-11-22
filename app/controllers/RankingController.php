<?php

class RankingController extends MasterController
{
	public function getRankingHome()
	{
		return View::make('ranking.home');
	}		

	public function getRankingList($game_id)
	{
		$sites	=	SitesModel::getSitesForGame($game_id);
		return $sites;
	}
}
