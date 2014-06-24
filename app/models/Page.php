<?php

class Page extends Eloquent {
	protected $table = 'pages';

	static public function findByName($name = '') {
		$results = Page::where('page', '=', $name)->get();

		if(count($results) == 1) {
			return $results[0];
		}

		return false;
	}

	public function getParsed() {
		$string = $this->content;
		$string = nl2br($string);

		return $string;
	}
}
