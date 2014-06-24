<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIrcNickVerified extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('irc_nicks', function($table) {
			$table->boolean('verified')->default(false);
			$table->string('verification', 32);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('irc_nicks', function($table) {
			$table->dropColumn('verification');
			$table->dropColumn('verified');
		});
	}

}
