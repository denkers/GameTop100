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
		$user	=	Auth::user();
		return self::where('user', '=', $user)
			->where(function($query) use ($readNotifications)
			{
				if($readNotifications != null)
					$query->where('isRead', '=', $readNotifications)

			})->orderBy('created_at');
	}

	public static function getNumNotifications($readNotifications)
	{
		return self::getUsersNotifications($readNotifcations)->count();
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
