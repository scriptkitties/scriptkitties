<?php

class BoardController extends BaseController {

	private $postsPerPage = 10;

	public function getIndex() {
		$boards = BbsBoard::all();

		return View::make('pages.bbs.index', [
			'boards' => $boards
		])->nest('nav', 'blocks.bbs.nav');
	}

	public function getBoard($board = '', $page = 0) {
		$posts = BbsPost::where('parent_id', '=', null)
			->orderBy('created_at')
			->skip($page * $this->postsPerPage)
			->take($this->postsPerPage)
			->get();

		return View::make('pages.bbs.board', [
			'posts' => $posts
		])->nest('nav', 'blocks.bbs.nav');
	}

	public function getPost($post = 0) {
	}

}
