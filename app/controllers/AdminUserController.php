<?php

class AdminUserController extends BaseController {

	public function getIndex() {
		return $this->getList();
	}

	public function getCreate() {
		return View::make('pages.user.create');
	}

	public function getEdit($user = 0) {
		$user = User::find($user);

		if($user == null) {
			App::abort(404);
		}

		return View::make('pages.user.edit', [
			'adminMode' => true,
			'user'      => $user
		]);
	}

	public function getList() {
		return View::make('pages.user.list', [
			'users' => User::all()
		]);
	}

	public function getPermissions($user = 0) {
		$user = User::find($user);

		if($user == null) {
			App::abort(404);
		}

		$permlist = [
			'bbs'   => 'BBS permissions',
			'user'  => 'User permissions',
			'pages' => 'Page permissions'
		];

		return View::make('pages.user.permissions', [
			'permlist' => $permlist,
			'user'     => $user
		]);
	}

	public function postCreate() {
		$rules = [
			'nickname' => 'required|unique:users',
			'email'    => 'required|unique:users|email'
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
		DB::table('permissions')->insert([
			'user_id'    => $user->id,
			'bbs'        => 6,
			'pages'      => 6,
			'user'       => 4,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		// Create preferences for the user
		DB::table('preferences')->insert([
			'user_id' => $user->id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

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

	public function postEdit($user = 0) {
		$user = User::find($user);

		if($user == null) {
			App::abort(404);
		}

		$rules = [
			'newpass'  => 'required|confirmed',
			'nickname' => 'required'
		];

		// Check if password is being updated and update rules accordingly
		if(Input::get('newpass') == '' && Input::get('newpass_confirmation') == '') {
			unset($rules['newpass']);
			echo 'a';
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('admin/user/edit/'.$user->id)->withErrors($validator);
		}

		// Update the user
		$e = $user->updateFromForm(true);

		if(count($e) > 0) {
			return Redirect::to('admin/user/edit/'.$user->id)->withErrors($e);
		}

		return Redirect::to('admin/user/edit/'.$user->id)->with('alert-success', trans('user.edit.success'));
	}

	public function postPermissions($user = 0) {
		$user = User::find($user);

		if($user == null) {
			App::abort(404);
		}

		$permlist = [
			'user',
			'bbs',
			'pages'
		];

		foreach($permlist as $perm) {
			$p = 0;

			if(Input::get($perm.'_read'))  { $p += 4; }
			if(Input::get($perm.'_write')) { $p += 2; }
			if(Input::get($perm.'_admin')) { $p += 1; }

			$user->setPermission($perm, $p);
		}

		return Redirect::to('admin/user/permissions/'.$user->id)->with('alert-success', trans('user.edit.success'));
	}

}
