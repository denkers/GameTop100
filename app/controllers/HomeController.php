<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	HomeController
//==================================


class HomeController extends MasterController
{
	public function getHome()
	{
		return View::make('home');
	}

	public function getGames()
	{
		
	}

	public function getGameList()
	{
		return GameCategoryModel::getCategoriesWithGames()->get();
	}
}
