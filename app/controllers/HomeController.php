<?php

class HomeController extends BaseController {

	public function getIndex() {
		return $this->getAbout();
	}

	public function getAbout() {
		$posts = BbsPost::orderBy('created_at', 'desc')->take(5)->get();
		$page[] = Page::findByName('about');
		$page[] = Page::findByName('github');
		$page[] = Page::findByName('irc');

		return View::make('pages.home.about', [
			'page'  => $page,
			'posts' => $posts
		]);
	}

	public function getIrc() {
		return View::make('pages.default', [
			'content' => Page::findByName('irc')->getParsed()
		]);
	}

}
