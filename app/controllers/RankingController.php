<?php

class RankingController extends MasterController
{
	public function getRankingHome()
	{
		return View::make('ranking.home');
	}		
}
