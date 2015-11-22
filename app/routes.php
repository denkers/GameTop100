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
	Route::post('/login', ['as' => 'postLogin', 'uses' => 'UserController@postLogin']);
	Route::post('/register', ['as' => 'postRegister', 'uses' => 'UserController@postRegister']);

	Route::group(['prefix' => 'profile'], function()
	{
		Route::get('/', ['as' => 'getProfile', 'uses' => 'UserController@getProfile']);
	});

	Route::group(['prefix' => 'sites'], function()
	{
		Route::post('/add', ['as' => 'postAddSite', 'uses' => 'SiteController@postAddSite']);
		Route::post('/remove', ['as' => 'postRemoveSite', 'uses' => 'SiteController@postRemoveSite']);
		Route::post('/edit', ['as' => 'postEditSite', 'uses' => 'SiteController@postEditSite']);
		Route::get('/mysites', ['as' => 'getMySites', 'uses' => 'SiteController@getMySites']);
		Route::post('/makepremium', ['as' => 'postMakePremiumSite', 'uses' => 'SiteController@postMakePremiumSite']);

		Route::group(['prefix' => 'site={site_id}'], function()
		{
			Route::get('/vote', ['as' => 'getSiteVote', 'uses' => 'SiteController@getSiteVote']);
			Route::post('/vote', ['as' => 'postSiteVote', 'uses' => 'SiteController@postSiteVote']);
		});
	});

});
