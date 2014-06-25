<?php

class MemberController extends BaseController {
	public function getIndex() {
		return $this->getList();
	}

	public function getList() {
		$members = User::all();

		return View::make('pages.members.list', [
			'members' => $members
		]);
	}

	public function getProfile($userid = 0) {
		if($userid == 0) {
			return App::abort(404);
		}

		$user = User::find($userid);

		if($user == null) {
			return App::abort(404);
		}

		return View::make('pages.user.control', [
				'user'        => $user,
				'showActions' => false
		]);
	}
}
