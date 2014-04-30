<?php

class BoardController extends BaseController {

	private $postsPerPage = 10;

	public function getIndex() {
		$posts = BbsBoard::orderBy('created_at')
			->limit($this->postsPerPage)
			->get();

		return View::make('pages.bbs.index', [
			'posts' => $posts
		])->nest('nav', 'blocks.bbs.nav');
	}

	public function getBoard($board = '', $page = 0) {
		if($board == '') {
			App::abort(404);
		}

		$board = BbsBoard::where('name', '=', $board)->get();

		if(count($board) != 1 || $board[0] == null) {
			App::abort(404);
		}

		$board = $board[0];

		$posts = BbsPost::where('parent_id', '=', null)
			->where('board_id', '=', $board->id)
			->orderBy('created_at')
			->skip($page * $this->postsPerPage)
			->take($this->postsPerPage)
			->get();

		return View::make('pages.bbs.board', [
			'posts' => $posts
		])->nest('nav', 'blocks.bbs.nav');
	}

	public function getPost($post = 0) {
		$post    = BbsPost::find($post);

		return View::make('pages.bbs.post', [
			'post'    => $post,
			'replies' => $post->replies()
		]);
	}

}
