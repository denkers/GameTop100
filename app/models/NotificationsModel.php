<?php

//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	NotificationsModel
//==================================

class NotificationsModel extends Eloquent
{
	protected $table	=	'notifications';

	public static function getUsersNotifications($readNotifications)
	{
		$user	=	Auth::user()->username;
		$isRead	=	$readNotifications;

		return self::where('user', '=', $user)
			->where(function($query) use ($isRead)
			{
				if($isRead != null)
					$query->where('isRead', '=', $isRead);

			})->orderBy('created_at');
	}

	public static function getNumNotifications($readNotifications)
	{
		return self::getUsersNotifications($readNotifications)->count();
	}

	public static function readNotification($notificationID)
	{
		$notification	=	NotificationsModel::find($notificationID);
		if($notification == null) return false;
		else
		{
			$notification->isRead	=	false;
			return $notification->save();
		}	
	}
}
