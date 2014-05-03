<?php

class HomeController extends BaseController {

	public function getIndex() {
		return $this->getAbout();
	}

	public function getAbout() {
		return View::make('pages.default', [
			'page' => Page::findByName('about')
		]);
	}

	public function getIrc() {
		return View::make('pages.default', [
			'page' => Page::findByName('irc')
		]);
	}

}
