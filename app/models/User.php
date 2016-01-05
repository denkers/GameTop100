<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	User
//==================================


use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $primaryKey = 'username';

	protected $hidden = ['password', 'remember_token'];
}
