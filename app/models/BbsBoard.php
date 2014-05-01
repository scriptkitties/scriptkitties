<?php

class BbsBoard extends Eloquent {
	protected $table      = 'bbs_boards';
	protected $softDelete = true;

	public function getPostcount() {
		$c = DB::table('bbs_posts')
			->where('board_id', '=', $this->id)
			->count();

		return $c;
	}
}
