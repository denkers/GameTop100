<?php

//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	GamesModel	
//==================================


class GameCategoryModel extends Eloquent
{
	protected $table	=	'game_categories';

	public function games()
	{
		return $this->hasMany('GamesModel', 'category_id');
	}	
}
