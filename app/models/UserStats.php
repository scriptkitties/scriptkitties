<?php

class UserStats extends Eloquent {
	protected $table = 'user_stats';

	public static function fromUser($userId = 0) {
		$results = DB::table($this->table)->where('user_id', '=', $userId)->get();

		if(count($results) != 1) {
			return null;
		}

		return self::find($results[0]->id);
	}

	public function user() {
		return $this->belongsTo('User');
	}
}
