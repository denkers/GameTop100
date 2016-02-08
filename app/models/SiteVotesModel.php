<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	SiteVotesModel
//==================================


class SiteVotesModel extends Eloquent
{
	protected $table	=	'site_votes';

	public static function getNumSiteVotes($site_id)
	{
		return self::where('site_id', '=', $site_id)->count();
	}

	public static function getRecentVoteForSite($site)
	{
		$num_hours	=	12;
		$carbon		=	new \Carbon\Carbon();
		$time		=	$carbon->subHours($num_hours);
		$ip			=	Request::getClientIp();

		return SiteVotesModel::where('site_id', '=', $site)
			->where('ip', '=', $ip)
			->where('isOut', '=', '0')	
			->where('created_at', '>', $time);
	}
}
