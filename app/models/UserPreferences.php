<?php

class UserPreferences extends Eloquent {
	protected $table = 'preferences';

	public function user() {
		$this->belongsTo('user');
	}
}
