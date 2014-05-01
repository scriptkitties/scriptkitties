<?php

class BbsPost extends Eloquent {
	protected $table = 'bbs_posts';

	public function htmlSafeContent() {
		$escape  = ['&', '<', '>', '\'', '"'];
		$replace = ['&amp;', '&lt;', '&gt;', '&quot;', '&#39'];

		return nl2br(str_replace($escape, $replace, $this->content));
	}

	public function replies() {
		return $this->where('parent_id', '=', $this->id)->get();
	}

	public function replyCount() {
		return $this->where('parent_id', '=', $this->id)->count();
	}
}
