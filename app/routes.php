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
Route::get('/login', ['as' => 'getLogin', 'uses' => 'UserController@getLogin']);
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
		Route::get('/', ['as' => 'getMySites', 'uses' => 'SiteController@getMySites']);
		Route::get('/all', ['as' => 'getMySiteList', 'uses' => 'SiteController@getMySiteList']);

		Route::post('/add', ['as' => 'postAddSite', 'uses' => 'SiteController@postAddSite']);

		Route::group(['prefix' => 'site={site_id}'], function()
		{
			Route::get('/view', ['as' => 'getSite', 'uses' => 'SiteController@getSite']);
			Route::post('/remove', ['as' => 'postRemoveSite', 'uses' => 'SiteController@postRemoveSite']);
			Route::post('/edit', ['as' => 'postEditSite', 'uses' => 'SiteController@postEditSite']);
			Route::post('/makepremium', ['as' => 'postMakePremiumSite', 'uses' => 'SiteController@postMakePremiumSite']);

			Route::group(['prefix' => 'comments'], function()
			{
				Route::get('/all', ['as' => 'getSiteComments', 'uses' => 'SiteController@getSiteComments']);
				Route::post('/add', ['as' => 'postAddSiteComment', 'uses' => 'SiteController@postAddSiteComment']);

				Route::group(['prefix' => 'comment={comment_id}'], function()
				{
					Route::post('/vote', ['as' => 'postVoteComment', 'uses' => 'SiteController@postVoteComment']);
					Route::post('/remove', ['as' => 'postRemoveComment', 'uses' => 'SiteController@postRemoveComment']);
					Route::post('/edit', ['as' => 'postEditComment', 'uses' => 'SiteController@postEditComment']);
				});
			});
		});

		Route::group(['prefix' => 'site={site_id}'], function()
		{
			Route::get('/vote', ['as' => 'getSiteVote', 'uses' => 'SiteController@getSiteVote']);
			Route::post('/vote', ['as' => 'postSiteVote', 'uses' => 'SiteController@postSiteVote']);
		});
	});
});
