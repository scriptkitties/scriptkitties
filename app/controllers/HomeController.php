<?php

class HomeController extends BaseController {

	public function getIndex() {
		return $this->getAbout();
	}

	public function getAbout() {
		$posts = BbsPost::orderBy('created_at', 'desc')->take(5)->get();

		return View::make('pages.home.about', [
			'page'  => Page::findByName('about'),
			'posts' => $posts
		]);
	}

	public function getIrc() {
		return View::make('pages.default', [
			'content' => Page::findByName('irc')->getParsed()
		]);
	}

}
