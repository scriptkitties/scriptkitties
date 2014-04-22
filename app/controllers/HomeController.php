<?php

class HomeController extends BaseController {

	public function getIndex() {
		return View::make('pages.home.about');
	}

	public function getAbout() {
		return $this->getIndex();
	}

	public function getIrc() {
		return View::make('pages.home.irc');
	}

}
