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

// Register handlers for HTTP error codes {{{
App::missing(function($e) {
	return Response::view('pages.default', [
		'title'   => trans('error.missing.title'),
		'content' => trans('error.missing')
	], 404);
});
// }}}

// Define composers
View::composer('layout', 'MainComposer');

// Allow public access to BBS
Route::get('bbs/post/{id}', 'BoardController@getPost');
Route::get('bbs/board/{name}', 'BoardController@getBoard');

// Member-only routes
Route::group(['before' => 'auth'], function() {
	Route::group(['prefix' => 'admin'], function() {
		Route::controller('user', 'AdminUserController', ['before', 'admin-user']);
		Route::controller('pages', 'AdminPageController', ['before', 'admin-pages']);
		Route::controller('bbs', 'AdminBbsController', ['before', 'admin-bbs']);
	});

	Route::controller('user', 'UserController');
	Route::controller('bbs', 'BoardController');
});

// Authentication routes, only for guests
Route::group(['before' => 'guest'], function() {
	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');
});

// Final route
Route::controller('/', 'HomeController');
