<?php

class BoardController extends BaseController {

	public function getIndex() {
		return View::make('pages.board.index');
	}

}
