<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', ['as' => 'getRankingHome', 'uses' => 'SiteController@getRankingHome']);
Route::get('/error', ['as' => 'getError', 'uses' => 'MasterController@getError']);
Route::get('/register', ['as' => 'getRegister', 'uses' => 'UserController@getRegister']);
Route::post('/checkusername', ['as' => 'postCheckUsername', 'uses' => 'UserController@postCheckUsername']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'UserController@postLogin']);
Route::post('/register', ['as' => 'postRegister', 'uses' => 'UserController@postRegister']);
Route::post('/robot/verify', ['as' => 'postRobotVerify', 'uses' => 'MasterController@postRobotVerify']);

Route::group(['prefix' => 'games'], function()
{
	Route::get('/', ['as' => 'getGames', 'uses' => 'HomeController@getGames']);
	Route::get('/list', ['as' => 'getGameList', 'uses' => 'HomeController@getGameList']);
});

Route::group(['prefix' => 'subscribers'], function()
{
	Route::post('/subscribe', ['as' => 'postUserSubscribe', 'uses' => 'UserController@postUserSubscribe']);
	Route::get('/info', ['as' => 'getSubInfo', 'uses' => 'UserController@getSubInfo']);
});

Route::group(['prefix' => 'sites'], function()
{
	Route::group(['prefix' => 'ranking'], function()
	{
		Route::get('/all', ['as' => 'getRankingSiteList', 'uses' => 'SiteController@getRankingSiteList']);

		Route::group(['prefix' => 'site={site_id}'], function()
		{
			Route::get('/view', ['as' => 'getSite', 'uses' => 'SiteController@getSite']);
			Route::group(['prefix' => 'comments'], function()
			{
				Route::post('/add', ['as' => 'postAddSiteComment', 'before' => 'auth', 'uses' => 'SiteController@postAddSiteComment']);
				Route::group(['prefix' => 'comment={comment_id}', 'before' => 'auth'], function()
				{
					Route::post('/rate', ['as' => 'postRateComment', 'uses' => 'SiteController@postRateComment']);
					Route::post('/remove', ['as' => 'postRemoveComment', 'uses' => 'SiteController@postRemoveComment']);
					Route::post('/edit', ['as' => 'postEditComment', 'uses' => 'SiteController@postEditComment']);
					Route::post('/report', ['as' => 'postReportComment', 'uses' => 'SiteController@postReportComment']);
				});
			});

			Route::group(['prefix' => 'vote'], function()
			{
				Route::get('/', ['as' => 'getSiteVote', 'uses' => 'SiteController@getSiteVote']);
				Route::post('/in', ['as' => 'postSiteVote', 'uses' => 'SiteController@postSiteVote']);
				Route::get('/check', ['as' => 'getSiteVoteCheck', 'uses' => 'SiteController@getSiteVoteCheck']);
				Route::post('/out', ['as' => 'postOutSiteVote', 'uses' => 'SiteController@postOutSiteVote']);
			});
		});
	});
});					

Route::group(['prefix' => 'user', 'before' => 'auth'], function()
{
	Route::get('/logout', ['as' => 'getLogout', 'uses' => 'UserController@getLogout']);
	Route::get('/settings', ['as' => 'getUserSettings', 'uses' => 'UserController@getUserSettings']);
	Route::group(['prefix' => 'profile'], function()
	{
		Route::get('/', ['as' => 'getProfile', 'uses' => 'UserController@getProfile']);
	});

	Route::group(['prefix' => 'sites'], function()
	{
		Route::get('/', ['as' => 'getMySites', 'uses' => 'SiteController@getMySites']);
		Route::get('/all', ['as' => 'getMySiteList', 'uses' => 'SiteController@getMySiteList']);
		Route::post('/add', ['as' => 'postAddSite', 'uses' => 'SiteController@postAddSite']);

		Route::group(['prefix' => 'site={site_id}'], function()
		{
			Route::post('/remove', ['as' => 'postRemoveSite', 'uses' => 'SiteController@postRemoveSite']);
			Route::post('/edit', ['as' => 'postEditSite', 'uses' => 'SiteController@postEditSite']);
			Route::post('/makepremium', ['as' => 'postMakePremiumSite', 'uses' => 'SiteController@postMakePremiumSite']);
		});
	});

	Route::group(['prefix' => 'notifications'], function()
	{
		Route::get('/', ['as' => 'getNotifications', 'uses' => 'UserController@getNotifications']);
		Route::get('/all', ['as' => 'getNotificationsList', 'uses' => 'UserController@getNotificationsList']);

		Route::group(['prefix' => 'notification={notification_id}'], function()
		{
			Route::post('/delete', ['as' => 'postDeleteNotification', 'uses' => 'UserController@postDeleteNotification']);
			Route::post('/read', ['as' => 'postReadNotification', 'uses' => 'UserController@postReadNotification']);
		});	
	});
});
