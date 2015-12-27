<?php

class SiteCommentsModel extends Eloquent
{
	protected $table = 'site_comments';

	public static function getCommentsForSite($site_id)
	{
		return self::where('site_id', '=', $site_id)->orderBy('created_at', 'desc')->get();
	}
}
