<?php

class UserController extends BaseController {

	public function getIndex() {
		return $this->getLogin();
	}

	public function getLogin() {
		if(true) {
			return View::make('pages.auth.loginform');
		}
	}

	public function getLogout() {
	}

	public function postLogin() {
	}

}
