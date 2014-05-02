<?php

class AdminUserController extends BaseController {

	public function getCreate() {
		$permlist = [
			'bbs'   => 'BBS permissions',
			'user'  => 'User permissions',
			'pages' => 'Page permissions'
		];

		return View::make('pages.user.create', [
			'permlist' => $permlist
		]);
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

		// Create permissions for the user
		DB::table('permissions')->insert(['user_id' => $user->id]);

		// Loop through all the permissions to set them
		foreach(Input::get('perms') as $perm) {
			$p = 0;

			if(Input::get($perm.'_read') == '1')  { $p += 4; }
			if(Input::get($perm.'_write') == '1') { $p += 2; }
			if(Input::get($perm.'_admin') == '1') { $p += 1; }

			$user->setPermission($perm, $p);
		}

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
