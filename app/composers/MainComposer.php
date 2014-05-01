<?php

class MainComposer {
	public function compose($view) {
		$view->with('bbsBoards', BbsBoard::orderBy('name')->get());
	}
}
