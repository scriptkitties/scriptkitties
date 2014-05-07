<?php

class BbsPost extends Eloquent {
	protected $table = 'bbs_posts';

	public static function getUploadPath($asUri = false) {
		if($asUri) {
			$path  = URL::to('/');
		} else {
			$path  = base_path();
			$path .= '/public';
		}

		$path .= '/img/bbs/';

		return $path;
	}

	public function getHeader($toParent = false) {
		if($this->author == null) {
			$name = trans('bbs.anon');
		} else {
			$name = link_to('user/profile/'.$this->author, User::find($this->author)->nickname);
		}

		$id   = link_to('bbs/post/'.$this->getParent(), $this->id);
		$date = $this->created_at;

		return trans('bbs.post.header', ['name' => $name, 'id' => $id, 'date' => $date]);
	}

	public function getParent() {
		if($this->parent_id != null) {
			return $this->parent_id;
		}

		return $this->id;
	}

	public function getParsed() {
		$escape  = ['&', '<', '>', '\'', '"'];
		$replace = ['&amp;', '&lt;', '&gt;', '&quot;', '&#39'];
		$string  = $this->content;

		// Replace unsafe HTML glyphs
		$string = str_replace($escape, $replace, $string);

		// Add <br> for newlines
		$string = nl2br($string);

		// Add greentext
		$string = preg_replace('/\&gt\;(.*)/', '<span class="greentext">>$1</span>', $string);

		// Return the parsed string
		return $string;
	}

	public function getUpload() {
		if(isset($this->file)) {
			return self::getUploadPath(true).$this->file.'.'.$this->extension;
		}

		return '';
	}

	public function replies() {
		return $this->where('parent_id', '=', $this->id)->get();
	}

	public function replyCount() {
		return $this->where('parent_id', '=', $this->id)->count();
	}
}
