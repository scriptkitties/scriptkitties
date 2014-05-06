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
		$board = BbsBoard::where('name', '=', $board)->get();

		if(count($board) != 1 || $board[0] == null) {
			App::abort(404);
		}

		$board = $board[0];

		$posts = BbsPost::where('parent_id', '=', null)
			->where('board_id', '=', $board->id)
			->orderBy('created_at', 'desc')
			->skip($page * $this->postsPerPage)
			->take($this->postsPerPage)
			->get();

		return View::make('pages.bbs.board', [
			'board' => $board,
			'posts' => $posts
		]);
	}

	public function getPost($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		$board = BbsBoard::find($post->board_id);

		return View::make('pages.bbs.post', [
			'board'   => $board,
			'post'    => $post,
			'replies' => $post->replies()
		]);
	}

	public function postBoard($board = '') {
		$board = BbsBoard::where('name', '=', $board)->get();

		if(count($board) != 1 || $board[0] == null) {
			App::abort(404);
		}

		$board = $board[0];
		$rules = [
			'content' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('bbs/board/'.$board->name)->withErrors($validator);
		}

		// Create the post
		$post = new BbsPost();
		$post->board_id = $board->id;
		$post->author   = (Input::get('anonify') == '1' ? null : Auth::user()->id);
		$post->content  = Input::get('content');

		// Add the uploaded file if included
		if(Input::hasFile('file')) {
			// Get the original extension
			$ext      = Input::file('file')->getClientOriginalExtension();
			$filename = hash_file('sha256', Input::file('file')->getRealPath());

			// Move the file
			Input::file('file')->move(BbsPost::getUploadPath(),  $filename.'.'.$ext);

			// Add the file to the reply
			$post->file      = $filename;
			$post->extension = $ext;
		}

		// Save the post into the database
		$post->save();

		return Redirect::to('bbs/post/'.$post->id);
	}

	public function postPost($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		if(Input::get('content') == '') {
			$rules = ['file' => 'required'];
		} else {
			$rules = ['content' => 'required'];
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			// Return the form with some errors
			return Redirect::to('bbs/post/'.$post->id)->withErrors($validator);
		}

		// Create the reply
		$reply = new BbsPost();
		$reply->board_id  = $post->board_id;
		$reply->parent_id = $post->id;
		$reply->author    = (Input::get('anonify') == '1' ? null : Auth::user()->id);
		$reply->content   = Input::get('content') == '' ? '' : Input::get('content');

		if(Input::hasFile('file')) {
			// Get the original extension
			$ext      = Input::file('file')->getClientOriginalExtension();
			$filename = hash_file('sha256', Input::file('file')->getRealPath());

			// Move the file
			Input::file('file')->move(BbsPost::getUploadPath(),  $filename.'.'.$ext);

			// Add the file to the reply
			$reply->file      = $filename;
			$reply->extension = $ext;
		}

		// Save the reply
		$reply->save();

		return Redirect::to('bbs/post/'.$post->id)->with('alert-success', trans('bbs.reply.success', [
			'id' => $reply->id
		]));
	}

}
