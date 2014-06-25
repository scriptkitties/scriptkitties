<?php

class MainComposer {
	public function compose($view) {
		if(Auth::check()) {
			$theme = Auth::user()->preferences->theme;

			// @todo: Check if there's a minified version and serve that if possible
		}

		$view->with('bbsBoards', BbsBoard::orderBy('name')->get());
		$view->with('theme', isset($theme) ? $theme : null);
	}
}
