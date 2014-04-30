<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoards extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('bbs_boards', function($table) {
			$table->increments('id');
			$table->string('name', 16);
			$table->text('description');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('bbs_posts', function($table) {
			$table->increments('id');
			$table->integer('board_id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('author');
			$table->string('file', 64)->nullable();
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();

			// Link board_id to bbs_boards.id
			$table->foreign('board_id')->references('id')->on('bbs_boards');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('bbs_posts');
		Schema::drop('bbs_boards');
	}

}
