<?php

class UserEditComposer {
	public function compose($view) {
		// Get all the themes from the directory
		$themeDir  = array_diff(scandir(base_path().'/public/css/themes'), ['.', '..']);
		$themes[0] = 'default';

		// Make it into an array for our use
		foreach($themeDir as $theme) {
			$t = substr($theme, 0, -4);
			$themes[$t] = $t;
		}

		$view->with('themes', $themes);
	}
}
