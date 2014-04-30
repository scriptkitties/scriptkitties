<?php

class BbsPost extends Eloquent {
	protected $table = 'bbs_posts';

	public function replies() {
		return $this->where('parent_id', '=', $this->id)->get();
	}

	public function replyCount() {
		return $this->where('parent_id', '=', $this->id)->count();
	}
}
