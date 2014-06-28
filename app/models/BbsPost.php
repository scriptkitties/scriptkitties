<?php

class BbsPost extends Eloquent {
	protected $table       = 'bbs_posts';
	private   $path        = 'img/bbs';
	private   $thumbSize   = [300, 300];

	public function getHeader($toParent = false) {
		if($this->author_id == null) {
			$name = trans('bbs.anon');
		} else {
			$name = link_to('user/profile/'.$this->author_id, User::find($this->author_id)->nickname);
		}

		$id   = link_to('bbs/post/'.$this->getParent().'#post-'.$this->id, $this->id, [
			'id' => 'post-'.$this->id
		]);
		$date = $this->created_at;

		$header  = trans('bbs.post.header', ['name' => $name, 'id' => $id, 'date' => $date]);

		return $header;
	}

	public function getImage($full = false) {
		return URL::to($this->path).(!$full?'/thumbs':'').'/'.$this->file.'.'.$this->extension;
	}

	public function getParent() {
		if($this->parent_id != null) {
			return $this->parent_id;
		}

		return $this->id;
	}

	public function getParsed($maxLength = 0) {
		// Make the content HTML safe

		// Return the fully parsed string
		return Markdown::parse($this->content);
	}

	public function setUploadedFile($field) {
		// Unset the previous data, if any
		$this->file      = null;
		$this->extension = null;

		// Update with the new file, if set
		if(Input::hasFile($field)) {
			// Get the original extension
			$ext      = Input::file($field)->getClientOriginalExtension();
			$filename = hash_file('sha256', Input::file($field)->getRealPath());
			$path     = base_path().'/public/'.$this->path;

			// Some extensions need fixing
			switch($ext) {
				case 'jpeg':
					$ext = 'jpg';
					break;
			}

			// Move the file
			Input::file($field)->move($path,  $filename.'.'.$ext);

			// Add the file to the reply
			$this->file      = $filename;
			$this->extension = $ext;

			// Generate a thumbnail
			App::make('Mews\Phpthumb\Phpthumb')->create('resize', [
				$path.'/'.$filename.'.'.$ext,
				$this->thumbSize[0],
				$this->thumbSize[1],
				'adaptive']
			)->save($path.'/thumbs/', $filename.'.'.$ext);

			return true;
		}

		return false;
	}

	public function replies($withDeleted = false) {
		if($withDeleted) {
			return self::withTrashed()->where('parent_id', '=', $this->id)->orderBy('created_at', 'ASC')->get();
		}

		return self::where('parent_id', '=', $this->id)->orderBy('created_at', 'ASC')->get();
	}

	public function replyCount() {
		return self::where('parent_id', '=', $this->id)->count();
	}
}
