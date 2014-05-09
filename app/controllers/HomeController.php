<?php

class HomeController extends BaseController {
	private $entriesPerPage = 100;

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

	public function getLogs($page = 0) {
		$logs = LogEntry::orderBy('created_at', 'desc')
			->skip($page * $this->entriesPerPage)
			->take($this->entriesPerPage)
			->get();

		return View::make('pages.home.logs', [
			'page' => Page::findByName('logs'),
			'logs' => $logs
		]);
	}

}
