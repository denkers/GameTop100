<?php

//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	NotificationsModel
//==================================

class NotificationsModel extends Eloquent
{
	protected $table	=	'notifications';

	public static function getUsersNotifications($user, $readNotifications)
	{
		return self::where('user', '=', $user)
				->where('isRead', '=', $readNotifications)
				->orderBy('created_at');
	}

	public static function getNumNotifications($user, $readNotifications)
	{
		return self::getUsersNotifications($user, $readNotifcations)->count();
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
