<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreferences extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('preferences', function($table) {
			$table->string('desktop')->default('')->after('theme');
			$table->string('irc_join')->default('')->after('desktop');
			$table->string('irc_part')->default('')->after('irc_join');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('preferences', function($table) {
			$table->dropColumn('desktop');
			$table->dropColumn('irc');
		});
	}

}
