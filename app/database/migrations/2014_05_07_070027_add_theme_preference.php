<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemePreference extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('preferences', function($table) {
			$table->string('theme', 32)->nullable()->after('anonymize');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('preferences', function($table) {
			$table->dropColumn('theme');
		});
	}

}
