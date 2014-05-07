<?php

class BbsPost extends Eloquent {
	protected $table     = 'bbs_posts';
	private   $path      = 'img/bbs';
	private   $thumbSize = [300, 300];

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

	public function getImage($full = false) {
		return URL::to($this->path).(!$full?'/thumbnails':'').'/'.$this->file.'.'.$this->extension;
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

	public function setUploadedFile($field) {
		if(Input::hasFile($field)) {
			// Get the original extension
			$ext      = Input::file($field)->getClientOriginalExtension();
			$filename = hash_file('sha256', Input::file($field)->getRealPath());
			$path     = base_path().'/public/'.$this->path;

			// Move the file
			Input::file($field)->move($path,  $filename.'.'.$ext);

			// Add the file to the reply
			$this->file      = $filename;
			$this->extension = $ext;

			// Generate a thumbnail
			App::make('Mews\Phpthumb\Phpthumb')->create('resize', [
				base_path().$this->path.$filename,
				$this->size[0],
				$this->size[1],
				'adaptive']
			)->save($path.'/thumbnails', $filename);

			return true;
		}

		return false;
	}

	public function replies() {
		return $this->where('parent_id', '=', $this->id)->get();
	}

	public function replyCount() {
		return $this->where('parent_id', '=', $this->id)->count();
	}
}
