<?php

class SiteVotesModel extends Eloquent
{
	protected $table	=	'site_votes';

	public static function getNumSiteVotes($site_id)
	{
		return self::where('site_id', '=', $site_id)->count();
	}
}
