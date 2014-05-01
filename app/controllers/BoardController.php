<?php

class BoardController extends BaseController {

	private $postsPerPage = 10;

	public function getIndex() {
		$posts = BbsBoard::orderBy('created_at')
			->limit($this->postsPerPage)
			->get();

		return View::make('pages.bbs.index', [
			'posts' => $posts
		]);
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
		]);
	}

	public function getPost($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		return View::make('pages.bbs.post', [
			'post'    => $post,
			'replies' => $post->replies()
		]);
	}

	public function postPost($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		$rules = [
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			// Return the form with some errors
			return Redirect::to('bbs/post/'.$post->id);
		}

		// Create the reply
		$reply = new BbsPost();
		$reply->board_id  = $post->board_id;
		$reply->parent_id = $post->id;
		$reply->author    = Auth::user()->id;
		$reply->content   = Input::get('content');;

		// @todo: file uploads

		// Save the reply
		$reply->save();

		return Redirect::to('bbs/post/'.$post->id);
	}

}
