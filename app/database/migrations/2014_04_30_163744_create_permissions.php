<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('permissions', function($table) {
			$table->integer('user_id')->unsigned();
			$table->tinyInteger('user')->default(0);
			$table->tinyInteger('pages')->default(0);
			$table->tinyInteger('bbs')->default(0);
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('permissions');
	}

}
