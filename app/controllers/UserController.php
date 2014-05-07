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

	public function getEdit() {
		// Get all the themes from the directory
		$themeDir = array_diff(scandir(base_path().'/public/css/themes'), ['.', '..']);

		// Make it into an array for our use
		foreach($themeDir as $theme) {
			$t = substr($theme, 0, -4);
			$themes[$t] = $t;
		}

		return View::make('pages.user.edit', [
			'user'   => Auth::user(),
			'themes' => array_merge(['default' => 'default'], $themes)
		]);
	}

	public function getLogin() {
		return View::make('pages.auth.loginform');
	}

	public function getLogout() {
		Auth::logout();

		return Redirect::to('/');
	}

	public function postEdit() {
		$rules = [
			'nickname' => 'required',
			'password' => 'required'
		];

		if(Input::get('newpass') != '' || Input::get('newpass_confirm')) {
			$rules['newpass'] = 'required|confirmed';
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('user/edit')->withErrors($validator);
		}

		// Get user as a local variable
		$user = Auth::user();

		if(!Hash::check(Input::get('password'), $user->password)) {
			return Redirect::to('user/edit')->with('alert-danger', trans('user.edit.falsepass'));
		}

		// Update the password if required
		if(Input::get('newpass') != '') {
			$user->password = Hash::make(Input::get('newpass'));
		}

		// Update other user settings
		$user->nickname = Input::get('nickname');
		$user->email    = Input::get('email');
		$user->website  = Input::get('website');

		// Update preferences
		$user->preferences->anonymize = Input::get('anonymize') == '1' ? true : false;
		$user->preferences->language  = Input::get('language');
		$user->preferences->theme     = Input::get('theme') == 'default' ? null : Input::get('theme');

		// Save the user's new settings
		$user->push();

		return Redirect::to('user/edit')->with('alert-success', trans('user.edit.success'));
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
