<?php

class AdminUserController extends BaseController {

	public function getCreate() {
		return View::make('pages.user.create');
	}

	public function postCreate() {
		$rules = [
			'nickname' => 'required',
			'email'    => 'required|email'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('admin/user/create')->withErrors($validator);
		}

		// Generate a random password
		$password = str_random(20);

		// Create the user
		$user = new User();
		$user->nickname = Input::get('nickname');
		$user->email    = Input::get('email');
		$user->password = Hash::make($password);;

		// Save the user's details
		$user->save();

		// Send an email to the newly created user with his/her newly created password #security
		Mail::send('emails.welcome', [
			'user'     => $user,
			'password' => $password,
			'referer'  => Auth::user()
		], function($message) use ($user) {
			$message->to($user->email, $user->nickname)->subject('Welcome to Scriptkitties!');
		});

		return Redirect::to('admin/user/create')->with('alert-success', trans('user.create.success', [
			'name'  => $user->nickname,
			'email' => $user->email
		]));

	}

}
