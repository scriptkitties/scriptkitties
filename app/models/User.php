<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\MessageBag;

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
	 * Attributes
	 */
	public function getCreatedAtAttribute() {
		return new DateTime($this->attributes['created_at']);
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

	public function ircNicks() {
		return $this->hasMany('IrcNick');
	}

	public function p5p() {
		return $this->hasOne('UserP5p');
	}

	public function preferences() {
		return $this->hasOne('UserPreferences');
	}

	public function updateFromForm($save = true) {
		$error = [];

		// Check for unique username if it has been changed
		if($this->nickname != Input::get('nickname')) {
			if(DB::table('users')->where('nickname', '=', Input::get('nickname'))->count() > 0) {
				$error[] = trans('validation.unique', ['attribute' => 'nickname']);
			}
		}

		// Check for unique email if it has been changed
		if($this->email != Input::get('email')) {
			if(DB::table('users')->where('email', '=', Input::get('email'))->count() > 0) {
				$error[] = trans('validation.unique', ['email' => 'nickname']);
			}
		}

		// Check for possible P5P errors
		// @todo: check if MOOD is allowed
		// @todo: check if USER-MIME-TYPE is allowed
		// @todo: check if AGE is integer
		// @todo: check if ACTUALAGE is integer

		if(count($error) > 0) {
			return new MessageBag($error);
		}

		// Hash a new password
		if(Input::get('newpass') != '') {
			$this->password = Hash::make(Input::get('newpass'));
		}

		// Log the change of username
		if($this->nickname != Input::get('nickname')) {
			LogEntry::takeNote('log.user.namechange', $this->id, $this->nickname, Input::get('nickname'));
		}

		// Update other user settings
		$this->nickname = Input::get('nickname');
		$this->email    = Input::get('email');
		$this->website  = Input::get('website');

		// Update preferences
		$this->preferences->anonymize = Input::get('anonymize') == '1' ? true : false;
		$this->preferences->language  = Input::get('language');
		$this->preferences->theme     = Input::get('theme') == 'default' ? null : Input::get('theme');
		$this->preferences->desktop   = Input::get('desktop');
		$this->preferences->irc_join  = Input::get('irc_join');
		$this->preferences->irc_part  = Input::get('irc_part');

		// Get a list of current nicknames
		$irc_nicks = $this->irc_nicks;

		// Make an empty $nicks array
		$nicks = [];

		// Make a clean array onicks
		foreach($irc_nicks as $n) {
			$nicks[$n->nick] = $n->nick;
		}

		// Add the entries from the form
		if(count(Input::get('irc_nick')) > 0) {
			foreach(Input::get('irc_nick') as $nick) {
				// Check wether it's a new nick
				if($nick != '' &&  !in_array($nick, $nicks)) {
					DB::table('irc_nicks')->insert([
						'user_id'      => $this->id,
						'nick'         => $nick,
						'verification' => md5($nick)
					]);
				}

				// Remove the nick from the $nicks array
				unset($nicks[$nick]);
			}
		}

		// Remove all leftover $nicks
		foreach($nicks as $n) {
			IrcNick::where('nick', '=', $n)->where('user_id', '=', $this->id)->delete();
		}

		// Update P5P
		foreach(UserP5p::$types as $token => $type) {
			$value = Input::get('p5p.'.$token);

			if($value == null) {
				continue;
			}

			$this->p5p->$token = Input::get('p5p.'.$token);
		}

		// Save the user's new settings
		if($save) {
			$this->push();
		}

		return [];
	}

	public function stats() {
		return $this->hasOne('UserStats');
	}

}
