<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken() {
		return $this->remember_token;
	}

	/**
	 * Check if a user has a certain permission.
	 *
	 * @return bool
	 */
	public function hasPermission($perm, $level) {
		$value = DB::table('permissions')->where('user_id', '=', $this->id)->pluck($perm);

		if($value == null) {
			return false;
		}

		switch($level) {
			case 'r':
			case 'read':
				$bit = 2;
				break;
			case 'w':
			case 'write':
				$bit = 1;
				break;
			case 'a':
			case 'admin':
				$bit = 0;
				break;
			default:
				return false;
		}

		return (($value >> $bit) & 1) == 1;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value) {
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName() {
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}

	public function setPermission($perm, $value) {
		return DB::table('permissions')->where('user_id', '=', $this->id)->update([$perm => $value]);
	}

	public function preferences() {
		return $this->hasOne('UserPreferences');
	}

}
