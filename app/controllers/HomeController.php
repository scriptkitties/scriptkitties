<?php

class HomeController extends BaseController {

	public function getIndex() {
		return $this->getAbout();
	}

	public function getAbout() {
		return View::make('pages.default', [
			'content' => Page::findByName('about')->getParsed()
		]);
	}

	public function getIrc() {
		return View::make('pages.default', [
			'content' => Page::findByName('irc')->getParsed()
		]);
	}

}
