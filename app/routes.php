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


Route::get('/', ['as' => 'getHome', 'uses' => 'MasterController@getHome']);
Route::get('/error', ['as' => 'getError', 'uses' => 'MasterController@getError']);
Route::get('/register', ['as' => 'getRegister', 'uses' => 'UserController@getRegister']);
Route::post('/checkusername', ['as' => 'postCheckUsername', 'uses' => 'UserController@postCheckUsername']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'UserController@postLogin']);
Route::post('/register', ['as' => 'postRegister', 'uses' => 'UserController@postRegister']);


Route::group(['prefix' => 'ranking'], function()
{
	Route::get('/', ['as' => 'getRankingHome', 'uses' => 'RankingController@getRankingHome']);
	Route::get('/game={game_id}/ranking', ['as' => 'getRankingList', 'uses' => 'RankingController@getRankingList']);
});

Route::group(['prefix' => 'subscribers'], function()
{
	Route::post('/subscribe', ['as' => 'postUserSubscribe', 'uses' => 'UserController@postUserSubscribe']);
	Route::get('/info', ['as' => 'getSubInfo', 'uses' => 'UserController@getSubInfo']);
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
		Route::group(['prefix' => 'mine'], function()
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

		Route::group(['prefix' => 'ranking'], function()
		{
			Route::get('/all', ['as' => 'getRankingSiteList', 'uses' => 'SiteController@getRankingSiteList']);

			Route::group(['prefix' => 'site={site_id}'], function()
			{
				Route::group(['prefix' => 'comments'], function()
				{
					Route::get('/all', ['as' => 'getSiteComments', 'uses' => 'SiteController@getSiteComments']);
					Route::post('/add', ['as' => 'postAddSiteComment', 'uses' => 'SiteController@postAddSiteComment']);

					Route::group(['prefix' => 'comment={comment_id}'], function()
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
					Route::post('/', ['as' => 'postSiteVote', 'uses' => 'SiteController@postSiteVote']);
				});
			});
		});	
	});
});
