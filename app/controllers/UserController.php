<?php

use \Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function getIndex() {
		return $this->getLogin();
	}

	public function getLogin() {
		return View::make('pages.auth.loginform');
	}

	public function getLogout() {
	}

	public function postLogin() {
		$rules = [
			'username' => 'required',
			'password' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			// Return the form with some errors
			return View::make('pages.auth.loginform');
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
			return Redirect::intended('/')->with('msg-success', Lang::get('auth.success'));
		}

		// Return an error to the user
		return Redirect::to('/user/login')->withErrors(new MessageBag([Lang::get('auth.error.creds')]));
	}

}
