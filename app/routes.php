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

// Define composers
View::composer('layout', 'MainComposer');

// Member-only routes
Route::group(['before' => 'auth'], function() {
	Route::group(['prefix' => 'admin'], function() {
		//Route::controller('user', 'AdminUserController', ['before', 'user-admin']);
		//Route::controller('pages', 'AdminPageController', ['before', 'page-admin']);
		Route::controller('bbs', 'AdminBbsController', ['before', 'bbs-admin']);
	});

	Route::controller('user', 'UserController');
	Route::controller('bbs', 'BoardController');
});

// Authentication routes
Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');

// Public routes
Route::controller('/', 'HomeController');
