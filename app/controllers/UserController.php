<?php

use \Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function getIndex() {
		return $this->getLogin();
	}

	public function getControl() {
		return View::make('pages.user.control', [
			'user'        => Auth::user(),
			'showActions' => true
		]);
	}

	public function getEdit() {
		return View::make('pages.user.edit', [
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

	public function getProfile($user = 0) {
		$user = User::find($user);

		if($user == null) {
			App::abort(404);
		}

		return View::make('pages.user.control', [
			'user' => $user,
		]);
	}

	public function postEdit() {
		$rules = [
			'newpass'  => 'required|confirmed',
			'nickname' => 'required',
			'password' => 'required'
		];

		// Check if password is being updated and update rules accordingly
		if(Input::get('newpass') == '' && Input::get('newpass_confirmation') == '') {
			unset($rules['newpass']);
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

		// Update the user
		$e = $user->updateFromForm(true);

		if(count($e) > 0) {
			return Redirect::to('user/edit')->withErrors($e);
		}

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
