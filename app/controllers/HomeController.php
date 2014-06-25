<?php

class HomeController extends BaseController {
	private $entriesPerPage = 100;

	public function getIndex() {
		return $this->getAbout();
	}

	public function getAbout() {
		// Get the 5 latest boardposts
		$posts = BbsPost::orderBy('created_at', 'desc')->take(5)->get();

		// Get the about-pages
		$page = Page::findByName('frontpage');

		// Get the best and worst users by epeen
		$epeenTop = UserStats::orderBy('epeen', 'DESC')->take(5)->get();
		$epeenBot = UserStats::orderBy('epeen', 'DESC')->skip(UserStats::count() - 3)->take(3)->get();

		// Create the about page
		return View::make('pages.home.about', [
			'page'     => $page,
			'posts'    => $posts,
			'epeenTop' => $epeenTop,
			'epeenBot' => $epeenBot,
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
