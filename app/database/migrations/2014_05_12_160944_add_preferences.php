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
			$table->string('irc', 64)->nullable()->after('anonymize');
			$table->string('desktop')->nullable()->after('irc');
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
