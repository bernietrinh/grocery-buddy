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

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

// Unauthenticated group
Route::group(array('before' => 'guest'), function() {

	// CSRF Protection group -- POST requests
	Route::group(array('before' => 'csrf'), function() {
		// Create account -- POST
		Route::post('/account/create', array(
			'as' => 'account-create',
			'uses' => 'AccountController@postCreate'
		));

		// Login -- POST
		Route::post('/account/login', array(
			'as' => 'account-login',
			'uses' => 'AccountController@postLogin'
		));

		//Forgot password -- POST
		Route::post('/account/forgot', array(
			'as' => 'account-forgot',
			'uses' => 'AccountController@postForgot'
		));

		Route::post('/account/recover', array(
			'as' => 'account-recover',
			'uses' => 'AccountController@postRecover'
		));
	});

	//Login -- GET
	Route::get('/account/login', array(
		'as' => 'account-login',
		'uses' => 'AccountController@getLogin'
	));

	// Create account -- GET
	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));

	//Forgot password -- GET
	Route::get('/account/forgot', array(
		'as' => 'account-forgot',
		'uses' => 'AccountController@getForgot'
	));

	//Recover password without code -- redirect home
	Route::get('/account/recover', function() {
		return View::make('home');
	});

	//Recover password with code -- GET 
	Route::get('/account/recover/{code}', array(
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	));

});

//Authenticated Group
Route::group(array('before' => 'auth'), function() {
	//Update settings -- GET
	Route::get('/account/update-settings', array(
		'as' => 'account-update-settings',
		'uses' => 'AccountController@getUpdateSettings'
	));

	//Log out -- GET
	Route::get('/account/logout', array(
		'as' => 'account-logout',
		'uses' => 'AccountController@getLogout'
	));

	//CSRF Group
	Route::group(array('before' => 'csrf'), function() {
		Route::post('/account/update-settings', array(
			'as' => 'account-update-settings',
			'uses' => 'AccountController@postUpdateSettings'
		));
	});
});

Route::get('/account/activate/{code}', array(
	'as' => 'account-activate',
	'uses' => 'AccountController@getActivate'
));