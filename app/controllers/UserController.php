<?php

use \Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function getIndex() {
		return $this->getLogin();
	}

	public function getControl() {
		return View::make('pages.user.control', [
			'user' => Auth::user()
		]);
	}

	public function getLogin() {
		return View::make('pages.auth.loginform');
	}

	public function getLogout() {
		Auth::logout();

		return Redirect::to('/');
	}

	public function postLogin() {
		$rules = [
			'username' => 'required',
			'password' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			// Return the form with some errors
			return View::make('pages.auth.loginform')->withErrors($validator);
		}

		// Should this session be remembered?
		$remember = Input::get('remember') > 0 ? true : false;

		// Fetch the credentials from the form
		$creds = [
			'nickname' => Input::get('username'),
			'password' => Input::get('password')
		];

		// Attempt to log the user in
		if(Auth::attempt($creds, $remember)) {
			// Return the user to the original page
			return Redirect::intended('user/control')->with('alert-success', trans('auth.success'));
		}

		// Return an error to the user
		return Redirect::to('login')->withErrors(new MessageBag([trans('auth.error.creds')]));
	}

}
