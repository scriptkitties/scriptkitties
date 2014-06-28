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
			'board'      => $board,
			'posts'      => $posts,
			'replyBlock' => View::make('blocks.bbs.reply', ['type' => 'new'])
		]);
	}

	public function getPost($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		$board = BbsBoard::find($post->board_id);

		return View::make('pages.bbs.post', [
			'board'      => $board,
			'post'       => $post,
			'replies'    => $post->replies((Auth::check() && Auth::user()->hasPermission('bbs', 'a'))),
			'replyBlock' => View::make('blocks.bbs.reply', ['type' => 'reply'])
		]);
	}

	public function getPostEdit($post = 0) {
		$post = BbsPost::find($post);

		if($post == null || !(Auth::check() && $post->author_id == Auth::user()->id)) {
			App::abort(404);
		}

		return View::make('pages.default', [
			'content' => View::make('blocks.bbs.reply', [
				'type'    => 'edit',
				'id'      => $post->id,
				'content' => $post->content
			]),
			'js' => View::make('blocks.bbs.reply_js')
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
		$post->board_id  = $board->id;
		$post->author_id = (Input::get('anonify') == '1' ? null : Auth::user()->id);
		$post->content   = Input::get('content');

		// Upload the file properly
		$post->setUploadedFile('file');

		// Save the post into the database
		$post->save();

		// Award the author with 1px of epeen if he didn't post anonymous
		if($post->author_id != null) {
			Auth::user()->stats->epeen++;
			Auth::user()->push();
		}

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
		$reply->author_id = (Input::get('anonify') == '1' ? null : Auth::user()->id);
		$reply->content   = Input::get('content') == '' ? '' : Input::get('content');

		// Upload the file properly
		$reply->setUploadedFile('file');

		// Save the reply
		$reply->save();

		// Award the author with 1px of epeen if he didn't post anonymous
		if($reply->author_id != null) {
			Auth::user()->stats->epeen++;
			Auth::user()->push();
		}

		return Redirect::to('bbs/post/'.$post->id)->with('alert-success', trans('bbs.reply.success', [
			'id' => $reply->id
		]));
	}

	public function postPostEdit($post = 0) {
		$post = BbsPost::find($post);

		if($post == null || Auth::user()->id != $post->author_id) {
			App::abort(404);
		}

		if(Input::get('img-update') == '1') {
			$post->setUploadedFile('file');
		}

		$post->content = Input::get('content');
		$post->save();

		return Redirect::to('bbs/post/'.$post->getParent().'#post-'.$post->id);
	}

}
