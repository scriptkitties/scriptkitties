<?php

class AdminBbsController extends BaseController {

	public function getCreate() {
		return View::make('pages.bbs.createboard');
	}

	public function getDelete($board = 0) {
		if($board > 0) {
			return $this->postDelete($board);
		}

		return View::make('pages.bbs.deleteboard', [
			'boards' => BbsBoard::all()
		]);
	}

	public function postCreate() {
		$rules = [
			'name' => 'required',
			'description' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('admin/bbs/create')->withErrors($validator);
		}

		$board              = new BbsBoard();
		$board->name        = Input::get('name');
		$board->description = Input::get('description');

		$board->save();

		return Redirect::to('bbs/board/'.Input::get('name'))->with('alert-success', trans('bbs.bbs.created', [
			'name' => $board->name
		]));
	}

	public function getPostDelete($post = 0) {
		$post = BbsPost::find($post);

		if($post == null) {
			App::abort(404);
		}

		$post->delete();

		return Redirect::to('bbs/post/'.$post->getParent().'#post-'.$post->id);
	}

	public function postDelete($board = 0) {
		$board = BbsBoard::find($board);

		if($board == null || $board->deleted_at != null) {
			App::abort(404);
		}

		$board->delete();

		return Redirect::to('admin/bbs/delete')->with('alert-success', trans('bbs.bbs.deleted', [
			'name' => $board->name
		]));;
	}

}
