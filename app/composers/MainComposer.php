<?php

class MainComposer {
	public function compose($view) {
		if(Auth::check()) {
			$theme = Auth::user()->preferences->theme;
		}

		$view->with('bbsBoards', BbsBoard::orderBy('name')->get());
		$view->with('theme', $theme ?: null);
	}
}
