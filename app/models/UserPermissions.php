<?php

class UserPermissions extends Eloquent {
	protected $table = 'permissions';

	public static function fromUser($userId = 0) {
		$results = DB::table('permissions')->where('user_id', '=', $userId)->get();

		if(count($results) != 1) {
			return null;
		}

		return self::find($results[0]->id);
	}

	public function user() {
		$this->belongsTo('user');
	}
}
